<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title></title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
    </head>
    <body>
        <h1 id="title">Mi van a hűtőben?</h1>

        <form>
            <div class="ingredients-group">
                <div class="form-group">
                    <input type="text" class="form-control" id="ingredients1" placeholder="Hozzávalók">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Keresés</button>
        </form>
        <script>
            $('.ingredients-group').on('input', function (event) {
                if ($("div.ingredients-group div:last-child > input").val() != "") {
                    var length = $(".ingredients-group > div").length
                    $(".ingredients-group").append("<div class='form-group'><input type='text' class='form-control' id='ingredients" + (length + 1) + "' placeholder='Hozzávalók'></div>");
                    $("#ingredients" + length + 1).autocomplete({
                        source: ingredients
                    });
                }
                ;
            });
        </script>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>
</html>
