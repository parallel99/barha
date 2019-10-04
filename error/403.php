<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title>BárHa | 403</title>
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
                Nincs hozzáférési jogosultsága ehhez a könyvtárhoz vagy fájlhoz!
            </div>
        </div>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
