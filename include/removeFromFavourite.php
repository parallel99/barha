<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
$name = $_POST['name'];
$email = $_POST['email'];

$stmt = $pdo->prepare("UPDATE users SET favourite = array_remove(favourite, '{" . $name . "}') WHERE email = '" . $email . "';");
$stmt->execute();
$data = $stmt->fetch();
