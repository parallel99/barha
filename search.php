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

    for ($i = 1; $i < 26; $i++) {
        $ingredients_name = 'ingredients' . $i;
        if (filter_has_var(INPUT_POST, $ingredients_name) && $_POST[$ingredients_name] != "") {
            $search->$ingredients_name = filter_input(INPUT_POST, $ingredients_name, FILTER_SANITIZE_STRING);
        }
    }
    print_r($search);
    echo "-----------------------------------------";
    $sql = "SELECT * FROM recipes WHERE status = 'accepted' ORDER BY uploadtime DESC LIMIT 50;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll();

    if ($stmt->rowCount() == 0) {
        echo "<div class=\"no-result\"><h3>" . _NO_RESULTS . "</h3></div>";
    }

    foreach ($data as $recipe) {
        $ingredients = json_decode($recipe->ingredients);
        foreach ($ingredients as $key => $value) {
            print_r($value->name);
        }
    }
    ?>

</div>
</body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
