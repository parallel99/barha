<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
$name = $_POST['name'];
$email = $_POST['email'];

$stmt = $pdo->prepare("UPDATE users SET favourite = favourite || \'{:name}\' WHERE email = :email;");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$data = $stmt->fetch();

print_r($stmt->errorInfo());

?>
