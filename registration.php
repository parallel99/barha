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

            if(isset($msg)){
                echo $msg;
                unset($msg);
            }
        ?>
        <div class="form-container">
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
        echo "izi";
            if(isset($_POST['submit'])) {
              echo "hello";
              die();

              $msg = "";
              $ok = true;

              $name      = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
              $email     = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
              $password1 = filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_STRING);
              $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING);


              if ($password1 != $password2) {
                  $msg .= '<div class="alert alert-danger alert-dismissible fade show">A két jelszó nem egyezik!</div>';
                  $ok = false;
              }

              if (mb_strlen($name) < 4 || mb_strlen($name) > 255) {
                  $msg .= '<div class="alert alert-danger alert-dismissible fade show">A névnek minimum 4 karakternek, maximum 255 karakternek kell lennie!</div>';
                  $ok = false;
              }

              if (mb_strlen($email) < 4 || mb_strlen($email) > 512) {
                  $msg .= '<div class="alert alert-danger alert-dismissible fade show">Az email-nek minimum 4 karakternek, maximum 512 karakternek kell lennie!</div>';
                  $ok = false;
              }

              if (mb_strlen($password1) < 4 || mb_strlen($password1) > 255) {
                  $msg .= '<div class="alert alert-danger alert-dismissible fade show">A jelszónak minimum 4 karakternek, maximum 255 karakternek kell lennie!</div>';
                  $ok = false;
              }

              if($ok){
                  $msg = '<div class="alert alert-success alert-dismissible fade show">Sikeres regisztráció!</div>';
              }

            }
        ?>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
