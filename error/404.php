<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title>BárHa | 404</title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body>
        <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
            menu("none");
        ?>
        <div class="error-container">
            <div class="shadow error-page">
               <h2>Az oldal nem található!</h2>
               <hr>
               Úgy néz ki valami hiba történt! Az oldal már nem létezik vagy nem is létezett!
               <hr>
               <input type="button" class="btn btn-primary" value="Vissza a főoldalra" onclick="document.location.href('/');">
            </div>
        </div>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
