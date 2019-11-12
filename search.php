<!DOCTYPE html>
<html lang="<? echo $_SESSION["lang"] ?? "hu"; ?>">
<head>
    <title>BárHa</title>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
menu("index");
?>
<div class="container">
    <?php
    if (!isset($_GET)) {
        echo "ez így nem jó";
    }

    $ingredients = array_unique(array_filter($_GET));
    print_r($ingredients);
    ?>
</div>
</body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
