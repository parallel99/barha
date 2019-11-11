<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';

$stmt = $pdo->prepare("SELECT name FROM ingredients ORDER BY name");
$stmt->execute();
$ingredients = array();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($ingredients, $row['name']);
}

echo '<script>ingredients.push("'.implode("\",\"", $ingredients).'")</script>';

