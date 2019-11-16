<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
$sql = "ALTER TABLE recipes ALTER COLUMN ingredients TYPE json;";
$stmt = $pdo->prepare($sql);
$stmt->execute();
