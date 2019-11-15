<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
$stmt = $pdo->prepare("UPDATE recipes SET lang = 'hu' WHERE 1 = 1");
$stmt->execute();

 ?>
