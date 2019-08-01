<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title></title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/navbar.php'; ?>
        <h1 id="title">Mi van a hűtőben?</h1>

        <form method="get">
            <div class="ingredients-group">
                <div class="form-group">
                    <input type="text" class="form-control" name="ingredients1" id="ingredients1" placeholder="Hozzávalók">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Keresés</button>
        </form>
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
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>
</html>
