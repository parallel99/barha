<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title></title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/navbar.php'; ?>
        <?php
            $ingredients = array_unique(array_filter($_GET));
            print_r($ingredients);
        ?>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>
</html>
