<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title>500</title>
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
                   <p>Internal Server Error</p>
                </div>
            </div>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
