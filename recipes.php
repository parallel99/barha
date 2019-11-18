<!DOCTYPE html>
<html lang="<? echo $_SESSION["lang"] ?? "hu"; ?>">
<head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    <title><?= _BARHA ?> | <?= _RECIPES ?></title>
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
menu("recipes");
if (!isset($_GET['search'])) {
    header("Location: recipes.php?search=");
    die();
}
?>
<div class="container recipe-list-container">
    <form method="get" class="row search shadow">
        <div class="input-group">
            <input type="text" class="form-control" name="search" id="search" placeholder="<?= _SEARCH ?>" value="<?php echo trim($_GET["search"]) ?? ""; ?>">
            <span class="input-group-btn" id="searchBtn-container">
                <button class="btn btn-primary" type="submit" id="searchBtn"><?= _SEARCH ?></button>
            </span>
            <span class="input-group-btn" id="advSearchBtn-container">
                <button class="btn btn-outline-primary" type="button" data-toggle="button" id="advSearchBtn">Részletes keresés</button>
            </span>
        </div>
        <div class="input-group pb-1" id="advSearchDiv">
            <div class="row">
                <div class="col-sm-4">
                    <label for="lang" class="w-100">Nyelv</label>
                    <select name="lang" class="custom-select mb-2 w-100">
                        <option>Mindegy</option>
                        <option>Angol</option>
                        <option>Magyar</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="time" class="w-100">Elkészítési idő</label>
                    <select name="time" class="custom-select mb-2 w-100">
                        <option>1 óra</option>
                        <option>2 óra</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="difficulty" class="w-100">Nehézség</label>
                    <select name="difficulty" class="custom-select w-100">
                        <option>Könnyű</option>
                        <option>Közepes</option>
                        <option>Nehéz</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <span class="input-group-btn m-0" id="searchBtn-container">
                        <button class="btn btn-primary mt-3" type="submit" id="searchBtn">Részletes keresés</button>
                    </span>
                </div>
            </div>
        </div>
        <script>
            $("#advSearchBtn").click(function () {
                $("#advSearchDiv").slideToggle();
            });
        </script>
    </form>
    <div class="recipes">
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/include/makingTime.php';

        if (isset($_GET['submit']) || isset($_GET['search'])) {
            $search = trim($_GET['search']);

            $sql = "SELECT * FROM recipes WHERE status = 'accepted' AND LOWER(name) LIKE LOWER('%" . $search . "%') ORDER BY uploadtime DESC LIMIT 50;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll();

            if ($stmt->rowCount() == 0) {
                echo '<div class="alert alert-info mt-3" role="alert">' . _NO_RESULTS . '</div>';
            }

            foreach ($data as $row) {
                ?>
                <a class="media" href="recipe/<?php echo $row->url; ?>">
                    <div class="media-left">
                        <?php
                        if (empty($row->image)) {
                            echo "<img src= \"/images/no-img.png\" loading=\"lazy\" alt=\"$row->name\">";
                        } else {
                            echo "<img src= \"$row->image\" loading=\"lazy\" alt=\"$row->name\">";
                        } ?>
                    </div>
                    <div class="media-body">
                        <h3><?php echo $row->name; ?></h3>
                        <h6><?= _PREPARATION_TIME_COLON ?>
                            <strong>
                                <?php echo MakingTime($row->makingtime); ?>
                            </strong>
                        </h6>
                    </div>
                </a>
                <?php
            }

            if ($stmt->rowCount() == 50) {
                echo "</div><div class=\"more-recipe\"><button class=\"btn btn-primary more-recipe-btn w-100\" id=\"more-recipe-btn\">" . _MORE . "</button></div>";
            }
        }
        ?>
    </div>
</body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
<script>
    count = 0;
    $(".more-recipe").on("click", ".more-recipe-btn", function () {
        count++;
        $.ajax({
            url: 'include/loadMoreRecipe.php',
            type: 'post',
            data: {
                "count": count,
                "search": $("#search").val()
            },
            success: function (response) {
                $('.recipes').append(response)
            },
            error: function () {
            }
        });
    });
</script>
</html>
