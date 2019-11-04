<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title>BárHa | 401</title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body>
        <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
            menu("none");
        ?>
        <div class="error-container">
            <div class="shadow error-page">
                <h2>Hozzáférési hiba!</h2>
                <hr>
                Csak bejelentkezés után megtekinthető oldal. Vagy nincs bejelentkezve vagy nincs jogosultságunk az oldal megtekintéséhez.
                <hr>
                <input type="button" class="btn btn-primary" value="Vissza a főoldalra" onclick="window.location.assign('/');">
            </div>
        </div>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
