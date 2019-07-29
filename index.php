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
                <div class="form-group">
                    <input type="text" class="form-control" id="ingredients2" placeholder="Hozzávalók">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Keresés</button>
        </form>
        <script>
        $('.ingredients-group').on('keydown', function(event) {
            console.log(event.keyCode);
            console.log($(".ingredients-group:last-child input").html());
            console.log($(".ingredients-group:last-child input").val());
         });
        </script>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>
</html>
