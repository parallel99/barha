<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title>BárHa | 400</title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body>
        <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
            menu("none");
        ?>
        <div class="error-container">
            <div class="shadow error-page">
                <h2>Kapcsolódási hiba!</h2>
                <hr>
                A böngésző kapcsolódni tud a kiszolgálóhoz, de a honlap nem található a címmel kapcsolatos hiba miatt. Általában a webcím pontatlan beírása miatt jelenik meg.
                <hr>
                <input type="button" class="btn btn-primary" value="Vissza a főoldalra" onclick="window.location.assign('/');">
            </div>
        </div>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
