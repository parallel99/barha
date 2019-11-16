<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
$sql = "ALTER TABLE recipes ADD COLUMN ingredientsteszt json;";
$stmt = $pdo->prepare($sql);
$stmt->execute();
