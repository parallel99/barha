<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title>BárHa | Receptek</title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body>
        <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
            menu("recipes");
        ?>
        <div class="container recipe-list-container">
            <div class="row">
                <div class="col-sm-3">
                    <img src="/images/test-recipe.jpg">
                </div>
                <div class="col-sm-9">
                    <h3>Almás pite</h3>
                    <h6>Feltöltés: 2019. szeptember 20.</h6>
                </div>
            </div>
        </div>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
