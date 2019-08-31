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
echo ($row);

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


if (isset($volt)) {
    if ($volt) {
        echo "<script>alert('Evvel a felhasználóval már megerősítették a regisztrációt!');</script>";
    } else {
        echo "<script>alert('Sikeresen megerősítette a regisztrációt!');</script>";
    }
} else {
    echo "<script>alert('Érvénytelen link!');</script>";
}
die();
header("Location: /");
