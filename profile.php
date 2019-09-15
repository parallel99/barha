<?php
if(!isset($_SESSION['user'])){
    header("Location: /");
    die();
}
?>
<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title>Étel-segéd | Profil</title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body>
        <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
            menu("profile");
        ?>
        <div class="container shadow">

        </div>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
