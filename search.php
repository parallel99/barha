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


    $sql = "SELECT * FROM recipes WHERE status = 'accepted' ORDER BY uploadtime DESC LIMIT 50;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_OBJ);

    if ($stmt->rowCount() == 0) {
        echo "<div class=\"no-result\"><h3>" . _NO_RESULTS . "</h3></div>";
    }



    foreach ($data->ingredients as $recipe) {
        $num = 0;
        $ingredients = json_decode($recipe);
        print_r($ingredients);
        /*foreach ($ingredients as $key => $value) {
          foreach ($search as $search_name => $search_ingredients) {
              if($value->name == $search_ingredients){
                $num = $num + 1;

              }

              print('$search_ingredients: ' . $search_ingredients. '<br>');
          }
          print('$value->name: ' . $value->name . '<br>');
        }
        if($num == count((array)$ingredients)){
           print $recipe->name;
           print "jó<br>";
        }*/
        /*foreach ($ingredients as $key => $value) {
            print $value->name;
        }
        print('$num: ' . $num . '<br>');
        print('$ingredients: ' . count((array)$ingredients) . '<br>');*/
    }
    ?>

</div>
</body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
