<?php
function Save(){
    $recipe_name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $making      = filter_input(INPUT_POST, "making", FILTER_SANITIZE_STRING);
    $std         = new \stdClass();
    $ingredients = array();
    $quantity    = array();
    $unit        = array();
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
              /*array_push($ingredients, filter_input(INPUT_POST, $ingredients_name, FILTER_SANITIZE_STRING));
              array_push($quantity, filter_input(INPUT_POST, $num_name, FILTER_SANITIZE_STRING));
              array_push($unit, filter_input(INPUT_POST, $unit_name, FILTER_SANITIZE_STRING));*/
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

    print_r($std);
    /*print_r($ingredients);
    print_r($quantity);
    print_r($unit);*/

    /*include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
    if($ok){
          $random   = mt_rand(10, 1000);
          $ticket   = $email . $random;
          $password = hash('sha512', $password1);
          $token    = hash('sha512', $ticket);
          $reg_time = date('Y-m-d H:i:s');

          $stmt = $pdo->prepare("INSERT INTO users(name, email, password, token, active, reg_time) VALUES (:name, :email, :password, :token, '0', :reg_time)");
          $stmt->bindParam(':name', $name, PDO::PARAM_STR);
          $stmt->bindParam(':email', $email, PDO::PARAM_STR);
          $stmt->bindParam(':password', $password, PDO::PARAM_STR);
          $stmt->bindParam(':token', $token, PDO::PARAM_STR);
          $stmt->bindParam(':reg_time', $reg_time, PDO::PARAM_STR);
          $stmt->execute();

          require_once($_SERVER['DOCUMENT_ROOT'] . '/include/mail-send.php');
          require_once($_SERVER['DOCUMENT_ROOT'] . '/include/mailconfirm.php');
          $Mail = new Mail($name, $email, "E-mail megerősítés", confirm($name, $token));
          $Mail->Send();

          $msg = '<div class="alert alert-success alert-dismissible fade show">Sikeres regisztráció!</div>';
          $_POST = array();
      }*/
}
