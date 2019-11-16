<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
$sql = "ALTER TABLE recipes ALTER COLUMN ingredients TYPE jsonb;";
$stmt = $pdo->prepare($sql);
$stmt->execute();
