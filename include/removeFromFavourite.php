<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
$name = $_POST['name'];
$email = $_SESSION['user']['email'];

$stmt = $pdo->prepare("UPDATE users SET favourite = array_remove(favourite, :name) WHERE email = :email;");
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->execute();
