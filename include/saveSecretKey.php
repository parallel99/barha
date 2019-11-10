<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
$email = $_SESSION['user']['email'];

$stmt = $pdo->prepare("UPDATE users SET secret_key = :secret WHERE email = :email");
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':secret', $_SESSION['secret'], PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_OBJ);
