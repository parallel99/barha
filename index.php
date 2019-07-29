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
                    <input type="text" class="form-control" class="ingredients" placeholder="Hozzávalók">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Keresés</button>
        </form>
        <script>
        $(".ingredients").last().keypress(function() {
            if($(".ingredients").val().last() != ""){
                $(".ingredients-group").append('<div class=\"form-group\"><input type=\"text\" class=\"form-control\" class=\"ingredients\" placeholder=\"Hozzávalók\"></div>');
            }
          console.log( "Handler for .keypress() called." );
        });
        </script>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>
</html>
