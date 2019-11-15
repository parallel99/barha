<?php
if (!isset($_SESSION['user']) || !isset($_GET['id'])) {
    header("Location: /recipes");
    die();
}

include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';

$sql = "SELECT * FROM recipes WHERE id = :id AND uploader = :email;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$stmt->bindValue(':email', $_SESSION['user']['email'], PDO::PARAM_STR);
$stmt->execute();
$recipe = $stmt->fetch(PDO::FETCH_OBJ);

if ($stmt->rowCount() != 1) {
    header("Location: /recipes");
    die();
}
?>
<!DOCTYPE html>
<html lang="<? echo $_SESSION["lang"] ?? "hu"; ?>">
<head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    <title><?= _BARHA ?> | <?= _UPLOAD_RECIPE ?></title>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/ingredients.php'; ?>
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
include $_SERVER['DOCUMENT_ROOT'] . '/include/SaveRecipe.php';
include $_SERVER['DOCUMENT_ROOT'] . '/include/units.php';
menu("recipe-upload");
if (isset($_POST["submit"])) {
    $upload = new SaveRecipe();
    $upload->Check(_UNITS);
    echo $upload->Update();
}
?>
<div class="form-container container recipe-container recipe-height">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name"><?= _RECIPE_NAME ?></label>
            <input type="text" class="form-control" name="name" autocomplete="off" id="name" placeholder="<?= _NAME ?>"
                   value="<?php echo $recipe->name; ?>" required>
        </div>
        <div class="form-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="customFile" id="customFile">
                <label class="custom-file-label" for="customFile"><?= _SELECT_IMG ?></label>
            </div>
        </div>
        <div class="form-group">
            <label for="makingtime"><?= _PREPARATION_TIME ?></label>
            <input type="time" step="300" name="makingtime" class="form-control time-input"
                   value="<?php echo date_format(date_create($recipe->makingtime), "H:i"); ?>" required>
        </div>
        <!-- Feladtam a custom select-et(EGYENLŐRE) mert nehéz automatán generálni-->
        <div class="ingredients-group">
            <?php
            $i = 1;
            $ingredients = json_decode($recipe->ingredients);
            foreach ($ingredients as $key => $value) {
                ?>
                <div class="form-group">
                    <?php if ($i == 1) {
                        echo '<label class="newLine"><?= _INGREDIENTS ?></label>';
                    } ?>
                    <input type="text" class="form-control ui-autocomplete-input upload-ingredients-name"
                           name="ingredients<?php echo $i; ?>" id="ingredients<?php echo $i; ?>" placeholder="<?= _INGREDIENT ?>"
                           value="<?php echo $value->name; ?>" autocomplete="off">
                    <input type="number" class="form-control ui-autocomplete-input upload-ingredients-db"
                           name="db<?php echo $i; ?>" id="db<?php echo $i; ?>" placeholder="<?= _QUANTITY ?>" min="1"
                           max="5000" value="<?php echo $value->quantity; ?>" autocomplete="off">
                    <select class="form-control ui-autocomplete-input upload-ingredients-unit"
                            id="unit<?php echo $i; ?>" name="unit<?php echo $i; ?>" autocomplete="off"
                            data-live-search="true">
                        <?php
                        echo "<option value='" . $value->unit . "'>" . $value->unit . "</option>";
                        foreach (_UNITS as $unit) {
                            if ($unit != $value->unit) {
                                echo "<option value='" . $unit . "'>" . $unit . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <?php
                $i = $i + 1;
            }
            ?>
            <div class="form-group">
                <input type="text" class="form-control ui-autocomplete-input upload-ingredients-name"
                       name="ingredients<?php echo $i; ?>" id="ingredients<?php echo $i; ?>" placeholder="<?= _INGREDIENT ?>"
                       autocomplete="off">
                <input type="number" class="form-control ui-autocomplete-input upload-ingredients-db"
                       name="db<?php echo $i; ?>" id="db<?php echo $i; ?>" placeholder="<?= _QUANTITY ?>" min="1" max="5000"
                       autocomplete="off">
                <select class="form-control ui-autocomplete-input upload-ingredients-unit" id="unit<?php echo $i; ?>"
                        name="unit<?php echo $i; ?>" autocomplete="off" data-live-search="true">
                    <?php
                    foreach (_UNITS as $unit) {
                        echo "<option value='" . $unit . "'>" . $unit . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <script>
            $('.ingredients-group').on('input', function () {
                let length = $(".ingredients-group > div").length
                if ($("div.ingredients-group div:last-child > input").val() !== "" && length < 25) {
                    var inputs = "<div class='form-group'><input type='text' class='form-control upload-ingredients-name' name='ingredients" + (length + 1) + "' id='ingredients" + (length + 1) + "' placeholder='<?= _INGREDIENT ?>'> ";
                    inputs += "<input type='number' class='form-control upload-ingredients-db' name='db" + (length + 1) + "' id='db" + (length + 1) + "' min='1' max='5000' placeholder='<?= _QUANTITY ?>'> ";
                    inputs += "<select class='form-control upload-ingredients-unit' id='unit" + (length + 1) + "' name='unit" + (length + 1) + "' autocomplete='off' data-live-search='true'>";
                    <?php foreach (_UNITS as $unit) {
                    echo "inputs +=" . "\"<option value='" . $unit . "'>" . $unit . "</option>\";\r\n\t\t\t\t\t\t\t";
                } ?>
                    inputs += "</select></div>";
                    $(".ingredients-group").append(inputs);
                    $("#ingredients" + (length + 1)).autocomplete({
                        source: ingredients
                    });
                }
            });
        </script>
        <div class="form-group">
            <label for="name"><?= _DIRECTIONS ?></label>
            <textarea class="form-control" name="making" placeholder="<?= _DIRECTIONS ?>"
                      rows="10" required><?php echo $recipe->making; ?></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary btn-upload"><?= _SAVE ?></button>
    </form>
</div>
</body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
<script>
    // A nevet változtatja a div-ben a fájl feltöltésnél
    $(".custom-file-input").on("change", function () {
        let fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
