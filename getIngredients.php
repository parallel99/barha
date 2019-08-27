<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';

$stmt = $pdo->prepare("SELECT name FROM ingredients ORDER BY name");
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $obj = json_encode($row['name']);
    echo "<script>ingredients.push(\"" . $row['name'] . "\")</script>";
}
echo $obj;
?>
