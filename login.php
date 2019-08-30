<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title></title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body>
        <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
            menu("login");
        ?>
        <div class="form-container">
          <?php
            if(isset($_POST['submit'])) {
                $msg = login();
                echo $msg;
                unset($msg);
            }
          ?>
            <form method="post" class="shadow" id="loginForm">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="password">Jelszó</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Jelszó">
                </div>
                <input type="submit" value="Bejelentkezés" class="btn btn-primary" name="submit">
                <a href="forgotten_password.php" class="small">Elfelejtetted a jelszavad?</a>
            </form>
        </div>
        <?php
            function login() {
              include ($_SERVER['DOCUMENT_ROOT'].'/include/db.php');

              $email     = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
              $password1 = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

              $password = hash('sha512', $password1);

              $stmt = $pdo->prepare("SELECT * FROM users WHERE email= :email AND password = :password");
              $stmt->bindValue(':email', $email, PDO::PARAM_STR);
              $stmt->bindValue(':password', $password, PDO::PARAM_STR);
              $stmt->execute();
              $stmt->fetch(PDO::FETCH_OBJ);
              $row = $stmt->fetchColumn();
$user =
              $find_user = false;
              $valid = false;

              if ($row == 1) {
                  $find_user = true;
              }

              if ($user->active && $find_user) {

                  $_SESSION['user'] = array('name' => $user->name, 'email' => $user->email);
                  $valid = true;
              }

              $pdo->close();

              if (!$find_user) {
                  $msg = '<div class="alert alert-danger alert-dismissible fade show">Hibás email vagy jelszó!</div>';
              } elseif (!$valid) {
                  $msg = '<div class="alert alert-danger alert-dismissible fade show">Még nem rősítette meg az email címét!</div>';
              }
            }
            echo $_SESSION['user']['name'];
        ?>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
