<?php
if (!isset($_GET["id"])) {
    header("Location: /");
    die();
}

include ($_SERVER['DOCUMENT_ROOT']. '/include/db.php');


$stmt = $pdo->prepare("SELECT active FROM users WHERE token = :token");
$stmt->bindValue(':token', $_GET["id"], PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_OBJ);
$row = $stmt->fetchColumn();

if($row == 1){
  if ($user->active == 1) {
      $volt = true;
  } else {
      $volt = false;
      $activate = $db->prepare("UPDATE users SET active = '1' WHERE token = :token");
      $stmt->bindValue(':token', $_GET["id"], PDO::PARAM_STR);
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

header("Location: /");
