<!DOCTYPE html>
<html lang="<? echo $_SESSION["lang"] ?? "hu"; ?>">
<head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    <title><?= _BARHA ?> | 414</title>
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
        Túl hosszú url!<br> Az oldal nem tekinthető meg, nem létezik ilyen hosszú url és nem is létezett.
        <hr>
        <input type="button" class="btn btn-primary" value="<?= _HOMEPAGE ?>" onclick="window.location.assign('/');">
    </div>
</div>
</body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
