<?php
function Save(){
      $msg = "";
      $ok = true;

      for($i = 1; $i < 26; $i++){
          $ingredients_name = 'ingredients'+$i;
          if(filter_has_var(INPUT_POST, $ingredients_name) && $ingredients_name != ""){
              $ingredients = array_push(filter_input(INPUT_POST, $ingredients_name, FILTER_SANITIZE_STRING));
          }
      }

      print_r($ingredients)
      /*
      $name      = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
      $email     = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
      $password1 = filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_STRING);
      $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING);

      if (isset($_POST['g-recaptcha-response'])) {
            $captcha = $_POST['g-recaptcha-response'];
        }
        $secretKey = "6LfJWrgUAAAAACD9V-GcW1nXwxwYQtIlpImmKbyo";
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) . '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response, true);
        if (!$responseKeys["success"]) {
            $msg .= '<div class="alert alert-danger alert-dismissible fade show">Hiba (ide ki kell talani valamit)</div>';
            $ok = false;
        }

      if(!filter_has_var(INPUT_POST, 'aszf')){
          $msg .= '<div class="alert alert-danger alert-dismissible fade show">Nem fogadtad el a felhasználói feltételeket!</div>';
          $ok = false;
      }

      if ($password1 != $password2) {
          $msg .= '<div class="alert alert-danger alert-dismissible fade show">A két jelszó nem egyezik!</div>';
          $ok = false;
      }

      if (strlen($name) < 4 || strlen($name) > 255) {
          $msg .= '<div class="alert alert-danger alert-dismissible fade show">A névnek minimum 4 karakternek, maximum 255 karakternek kell lennie!</div>';
          $ok = false;
      }

      if (strlen($email) < 4 || strlen($email) > 512) {
          $msg .= '<div class="alert alert-danger alert-dismissible fade show">Az email-nek minimum 4 karakternek, maximum 512 karakternek kell lennie!</div>';
          $ok = false;
      }

      if (strlen($password1) < 4 || strlen($password1) > 255) {
          $msg .= '<div class="alert alert-danger alert-dismissible fade show">A jelszónak minimum 4 karakternek, maximum 255 karakternek kell lennie!</div>';
          $ok = false;
      }

      include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';

      $getemail = $pdo->prepare("SELECT * FROM users WHERE email = :email;");
      $getemail->bindValue(':email', $email, PDO::PARAM_STR);
      $getemail->execute();
      $row = $getemail->rowCount();

      if($row > 0){
          $msg .= '<div class="alert alert-danger alert-dismissible fade show">Ez az email cím már foglalt!</div>';
          $ok = false;
      }

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
