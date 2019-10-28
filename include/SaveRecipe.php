<?php
function Save(){
    $recipe_name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $making      = filter_input(INPUT_POST, "making", FILTER_SANITIZE_STRING);
    $std         = new \stdClass();
    $msg         = "";
    $ok          = true;

    for($i = 1; $i < 26; $i++){
        $ingredients_name = 'ingredients' . $i;
        $num_name         = 'db' . $i;
        $unit_name        = 'unit' . $i;
        if(filter_has_var(INPUT_POST, $ingredients_name) && $_POST[$ingredients_name] != ""){
            if (filter_input(INPUT_POST, $num_name, FILTER_SANITIZE_STRING) != "") {
              $std->$ingredients_name = new \stdClass();
              $std->$ingredients_name->name = filter_input(INPUT_POST, $ingredients_name, FILTER_SANITIZE_STRING);
              $std->$ingredients_name->quantity = filter_input(INPUT_POST, $num_name, FILTER_SANITIZE_STRING);
              $std->$ingredients_name->unit = filter_input(INPUT_POST, $unit_name, FILTER_SANITIZE_STRING);
            } else {
              $msg .= '<div class="alert alert-danger alert-dismissible fade show">Nem adta meg a mennyiséget a hozzávalóknál!</div>';
              $ok = false;
            }
        }
    }

    if (mb_strlen($recipe_name) < 3 || mb_strlen($recipe_name) > 255) {
        $msg .= '<div class="alert alert-danger alert-dismissible fade show">A recept nevének minimum 3 karakternek, maximum 255 karakternek kell lennie!</div>';
        $ok = false;
    }

    if (mb_strlen($making) < 10 || mb_strlen($making) > 5000) {
        $msg .= '<div class="alert alert-danger alert-dismissible fade show">A recept leírásának minimum 10 karakternek, maximum 5000 karakternek kell lennie!</div>';
        $ok = false;
    }

    if($ok){
          include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
          $ingredients = json_encode($std);
          $upload_time = date('Y-m-d H:i:s');
          $url = urlencode("/"."recipe/".$recipe_name);

          $stmt = $pdo->prepare("INSERT INTO recipebeta(name, ingredients, making, uploader, uploadtime, url) VALUES (:name, :ingredients, :making, :uploader, :uploadtime, :url)");
          $stmt->bindParam(':name', $recipe_name, PDO::PARAM_STR);
          $stmt->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
          $stmt->bindParam(':making', $making, PDO::PARAM_STR);
          $stmt->bindParam(':uploader', $_SESSION['user']['name'], PDO::PARAM_STR);
          $stmt->bindParam(':uploadtime', $upload_time, PDO::PARAM_STR);
          $stmt->bindParam(':url', $url, PDO::PARAM_STR);
          $stmt->execute();

          $msg = '<div class="alert alert-success alert-dismissible fade show">Sikeresen elküldte a receptet!</div>';
          $_POST = array();
          unset($_POST);
      }

      return $msg;
}
