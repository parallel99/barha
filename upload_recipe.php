<?php
if(!isset($_SESSION['user'])){
    header("Location: /");
    die();
}
?>
<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title>BárHa | </title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/ingredients.php'; ?>
    </head>
    <body>
        <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
            menu("recipe-upload");
        ?>
        <div class="form-container container recipe-container">
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
                        <input type="text" class="form-control" name="ingredients1" id="ingredients1" placeholder="Hozzávalók">
                    </div>
                </div>
                <script>
                    $('.ingredients-group').on('input', function (event) {
                        var length = $(".ingredients-group > div").length
                        if ($("div.ingredients-group div:last-child > input").val() != "" && length < 25) {
                            $(".ingredients-group").append("<div class='form-group'><input type='text' class='form-control' name='ingredients" + (length + 1) + "' id='ingredients" + (length + 1) + "' placeholder='Hozzávalók'></div>");
                            $("body").css("background", "linear-gradient(40deg, #2096ff, #05ffa3)");
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
