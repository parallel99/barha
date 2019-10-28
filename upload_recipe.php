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
            include $_SERVER['DOCUMENT_ROOT'] . '/include/SaveRecipe.php';
            if(isset($_POST["submit"])){
                echo Save();
            }
        ?>
        <div class="form-container container recipe-container recipe-height">
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
                        <label class="newLine">Hozzávalók</label>
                        <input type="text" class="form-control ui-autocomplete-input upload-ingredients-name" name="ingredients1" id="ingredients1" placeholder="Hozzávaló" autocomplete="off">
                        <input type="number" class="form-control ui-autocomplete-input upload-ingredients-db" name="db1" id="db1" placeholder="Mennyiség" min="1" max="5000" autocomplete="off">
                        <select class="form-control ui-autocomplete-input upload-ingredients-unit" id="unit1" name="unit1" autocomplete="off">
                          <?php
                              foreach (units() as $unit) {
                                  echo "<option value='" . $unit. "'>" . $unit . "</option>";
                              }
                          ?>
                        </select>
                    </div>
                </div>
                <script>
                    $('.ingredients-group').on('input', function (event) {
                        var length = $(".ingredients-group > div").length
                        if ($("div.ingredients-group div:last-child > input").val() != "" && length < 25) {
                            var inputs = "<div class='form-group'><input type='text' class='form-control upload-ingredients-name' name='ingredients" + (length + 1) + "' id='ingredients" + (length + 1) + "' placeholder='Hozzávaló'> ";
                            inputs += "<input type='number' class='form-control upload-ingredients-db' name='db" + (length + 1) + "' id='db" + (length + 1) + "' min='1' max='5000' placeholder='Mennyiség'> ";
                            inputs += "<select class='form-control ui-autocomplete-input upload-ingredients-unit' id='unit" + (length + 1) + "' name='unit" + (length + 1) + "' autocomplete='off'>";
                            <?php foreach (units() as $unit) { echo "inputs +=" . "\"<option value='" . $unit. "'>" . $unit . "</option>\";"; } ?>;
                            inputs += "</select></div>";
                            $(".ingredients-group").append(inputs);
                            $("#ingredients" + (length + 1)).autocomplete({
                                source: ingredients
                            });
                        }
                        ;
                    });
                </script>
                <div class="form-group">
                    <label for="name">A recept elkészítésének módja</label>
                    <textarea class="form-control" name="making" placeholder="Ide írhatja a recept elkészítésének a leírását" rows="10"></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-upload">Beküld</button>
            </form>
        </div>
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
<?php
  function units(){
      $unit = array("db", "g", "dkg", "kg", "liter", "dl", "cl", "ml",
                    "merőkanál", "evőkanál", "kiskanál", "mokkáskanál",
                    "bögre", "csésze", "marék", "gereszd", "csokor",
                    "csomag");

      return $unit;
  }
?>
