<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title>BárHa | 500</title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body>
        <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
            menu("none");
        ?>
            <div class="error-container">
                <div class="shadow error-page">
                   <h2>500</h2>
                   <hr>
                   Internal Server Error
                   <hr>
                   <input type="button" class="btn btn-primary" value="Vissza a főoldalra" onclick="document.location.href('/');">
                </div>
            </div>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
