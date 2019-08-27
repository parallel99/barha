<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';

$stmt = $pdo->prepare("SELECT name FROM ingredients ORDER BY name");
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $tomb = array();
    array_push($tomb, $row['name']);
    echo "<script>ingredients.push(\"" . $row['name'] . "\")</script>";
}
print $tomb[2];
?>
