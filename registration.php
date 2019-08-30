<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title></title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body>
        <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
            menu("registration");
        ?>
        <div class="form-container">
          <?php
            if(isset($_POST['submit'])) {
                $msg = registration();
                echo $msg;
                unset($msg);
                unset($_POST['submit']);
            }
          ?>
            <form method="post" class="shadow" id="registrationForm">
                <div class="form-group">
                    <label for="name">Név</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Név">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="password1">Jelszó</label>
                    <input type="password" class="form-control" name="password1" id="password1" placeholder="Jelszó">
                </div>
                <div class="form-group">
                    <label for="password2">Jelszó megerősítése</label>
                    <input type="password" class="form-control" name="password2" id="password2" placeholder="Jelszó megerősítése">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="aszf" name="aszf">
                    <label class="form-check-label small" for="aszf">
                        Elfogadom a <div class="aszf" data-toggle="modal" data-target="#myModal">felhasználási feltételeket</div>.
                    </label>
                </div>
                <input type="submit" name="submit" value="Regisztráció" class="btn btn-primary">
            </form>
        </div>
        <!-- felhasználási feltételek ablak-->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Felhasználási feltételek</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>PLS ez legyen a felhasználói feltételek helye.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Bezár</button>
                </div>
            </div>
        </div>
        </div>
        <?php

        function registration(){
              $msg = "";
              $ok = true;

              $name      = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
              $email     = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
              $password1 = filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_STRING);
              $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING);

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

              $getemail = $pdo->prepare("SELECT id FROM users WHERE email = :email;");
              $getemail->bindValue(':email', $email, PDO::PARAM_STR);
              $getemail->execute();
              $row = $getemail->fetch(PDO::FETCH_OBJ);

              if($row->num_rows > 0){
                  $msg .= '<div class="alert alert-danger alert-dismissible fade show">Evvel az email-el regisztráltak már!</div>';
                  $ok = false;
              }

              if($ok){

                  $random   = mt_rand(10, 1000);
                  $ticket   = $email . $random;
                  $password = hash('sha512', $password1);
                  $token    = hash('sha512', $ticket);

                  $stmt = $pdo->prepare("INSERT INTO users(name, email, password, token, active) VALUES (:name, :email, :password, :token, '1')");
                  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                  $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                  $stmt->bindParam(':token', $token, PDO::PARAM_STR);
                  $stmt->execute();

                  $msg = '<div class="alert alert-success alert-dismissible fade show">Sikeres regisztráció!</div>';
              }

              return $msg;
          }
        ?>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
