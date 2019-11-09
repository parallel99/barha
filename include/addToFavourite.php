<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
$name = $_POST['name'];
$email = $_SESSION['user']['email'];

$stmt = $pdo->prepare("UPDATE users SET favourite = favourite || '{" . $name . "}' WHERE email = '" . $email . "' AND favourite NOT LIKE favourite || '{" . $name . "}';");
$stmt->execute();
$data = $stmt->fetch();

?>
