<!DOCTYPE html>
<html lang="<? try {echo $_SESSION['user']['lang'];}catch(e){echo 'hu';} ?>">
<head>
    <title>BárHa | 414</title>
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
        Túl hosszú url!<br> Az oldal nem tekinthető meg, nem létezik ilyen hosszú url és nem is létezett.
        <hr>
        <input type="button" class="btn btn-primary" value="Vissza a főoldalra" onclick="window.location.assign('/');">
    </div>
</div>
</body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
