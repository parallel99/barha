<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
$name = $_POST['name'];

$stmt = $pdo->prepare("UPDATE users SET favourite = favourite || ':name';");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->execute();
$data = $stmt->fetchAll();

?>
