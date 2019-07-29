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
        $('.ingredients-group').on('keypress', function(event) {
            console.log($("div.ingredients-group div:last-child > input").val());
            if($("div.ingredients-group div:last-child > input").val() != "") {
                $(".ingredients-group").append('<div class=\"form-group\"><input type=\"text\" class=\"form-control\" id=\"ingredients\" placeholder=\"Hozzávalók\"></div>');
                console.log("i: " + $(".ingredients-group > div").length);
            }
         });
        </script>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>
</html>
