<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title>BárHa | kedvencek</title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
        menu("favourite");
        ?>
        <div class="container favourite-list-container">
            <div class="favourite">
        </div>
    </body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
