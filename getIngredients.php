<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';

$stmt = $pdo->prepare("SELECT name FROM ingredients");
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<script>ingredients.push(\"" . $row['name'] . "\")</script>";
}
?>
