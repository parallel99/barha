<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
$name = $_POST['name'];
$email = $_SESSION['user']['email'];

$stmt = $pdo->prepare("UPDATE users SET favourite = favourite || '{" . $name . "}' WHERE email = '" . $email . "';");
$stmt->execute();
$data = $stmt->fetch();

?>
