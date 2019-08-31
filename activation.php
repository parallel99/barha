<?php
if (!isset($_GET["id"])) {
    header("Location: /");
    die();
}

include ($_SERVER['DOCUMENT_ROOT']. '/include/db.php');


$stmt = $pdo->prepare("SELECT * FROM users WHERE token = :token");
$stmt->bindValue(':token', $_GET["id"], PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->rowCount();
$user = $stmt->fetch(PDO::FETCH_OBJ);

if($row == 1){
  if ($user->active == 1) {
      $volt = true;
  } else {
      $volt = false;
      $activate = $pdo->prepare("UPDATE users SET active = '1' WHERE token = :token");
      $activate->bindValue(':token', $_GET["id"], PDO::PARAM_STR);
      $activate->execute();
  }
}
?>
<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title>E-mail megerősítése</title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body>
        <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
            menu("none");
        ?>
        <div class="form-container">
            <div class="shadow email-confirm">
                <?php
                  if (isset($volt)) {
                      if ($volt) {
                        echo "<h1>Sikertelen megerősítés</h1>";
                        echo "<div>Evvel a felhasználóval már megerősítették a regisztrációt!</div>";
                      } else {
                        echo "<h1>Sikeres megerősítés</h1>";
                        echo "<div>Sikeresen megerősítette a regisztrációt!</div>";
                      }
                  } else {
                    echo "<h1>Sikeres megerősítés</h1>";
                    echo "<div>Érvénytelen link!</div>";
                  }
                ?>
                <div>
                  Visszalépés a főoldalra: <a href="/" class="btn btn-primary">Főoldal</a>
                </div>
            </div>
        </div>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
