<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
$id = $_POST['id'];
$email = $_SESSION['user']['email'];

$stmt = $pdo->prepare("UPDATE users SET favourite = array_remove(favourite, :id) WHERE email = :email;");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->execute();
