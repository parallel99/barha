<?php
if(!isset($_SESSION['user'])){
    header("Location: /");
    die();
}
?>
<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title>BárHa | Recept feltöltés</title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/ingredients.php'; ?>
    </head>
    <body>
        <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
            menu("recipe-upload");
        ?>
        <div class="form-container container recipe-container recipe-height">
          <?php
            if(isset($_POST['submit'])) {
                $msg = registration();
                echo $msg;
                unset($msg);
            }
          ?>
            <form method="post">
                <div class="form-group">
                    <label for="name">A recept neve</label>
                    <input type="text" class="form-control" name="name" autocomplete="off" id="name" value="<?php echo $_POST["name"] ?? "";?>" placeholder="Név" required>
                </div>
                <div class="form-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Válassz képet</label>
                  </div>
                </div>
                <div class="ingredients-group">
                    <div class="form-group">
                        <label for="name">Hozzávalók</label>
                        <input type="text" class="form-control ui-autocomplete-input upload-ingredients-name" name="ingredients1" id="ingredients1" placeholder="Hozzávalók" autocomplete="off">
                        <input type="number" class="form-control ui-autocomplete-input upload-ingredients-db" name="db1" id="db1" placeholder="Mennyiség" min="1" max="5000" autocomplete="off">
                        <select class="form-control ui-autocomplete-input upload-ingredients-unit" id="unit1" name="unit1" autocomplete="off">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                        </select>
                    </div>
                </div>
                <script>
                    $('.ingredients-group').on('input', function (event) {
                        var length = $(".ingredients-group > div").length
                        if ($("div.ingredients-group div:last-child > input").val() != "" && length < 25) {
                            $(".ingredients-group").append("<div class='form-group'><input type='text' class='form-control upload-ingredients-name' name='ingredients" + (length + 1) + "' id='ingredients" + (length + 1) + "' placeholder='Hozzávalók'><input type='number' class='form-control upload-ingredients-db' name='db" + (length + 1) + "' id='db" + (length + 1) + "' min='1' max='5000' placeholder='Mennyiség'>");
                            $("#ingredients" + (length + 1)).autocomplete({
                                source: ingredients
                            });
                        }
                        ;
                    });
                </script>
                <div class="form-group">
                    <label for="name">A recept elkészítésének módja</label>
                    <textarea class="form-control" placeholder="Ide írhatja a recept elkészítésének a leírását" rows="10"></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-upload">Beküld</button>
            </form>
        </div>
        <?php

        ?>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
<script>
// A nevet változtatja a div-ben a fájl feltöltésnél
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
