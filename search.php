<!DOCTYPE html>
<html lang="<? echo $_SESSION["lang"] ?? "hu"; ?>">
<head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    <title><?= _BARHA ?></title>
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
menu("index");
?>
<div class="container">
    <?php
    $search = new \stdClass();

    //$ingredients = array_unique(array_filter($_GET));

    for ($i = 1; $i < 26; $i++) {
        $ingredients_name = 'ingredients' . $i;
        if (filter_has_var(INPUT_POST, $ingredients_name) && $_POST[$ingredients_name] != "") {
            $search->$ingredients_name = filter_input(INPUT_POST, $ingredients_name, FILTER_SANITIZE_STRING);
        }
    }
    print_r($search);
    ?>
</div>
</body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
