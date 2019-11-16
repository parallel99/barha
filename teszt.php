<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
$sql = "CREATE TABLE orders (
   ID serial NOT NULL PRIMARY KEY,
   info json NOT NULL
);";
$stmt = $pdo->prepare($sql);
$stmt->execute();
