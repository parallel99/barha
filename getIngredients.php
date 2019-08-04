<?php

include $_SERVER['DOCUMENT_ROOT'] . '/db.php';

$stmt = $pdo->prepare("SELECT name FROM ingredients");
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['name'] . ";";
}
?>
