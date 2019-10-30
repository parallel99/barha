<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';

$stmt = $pdo->prepare("SELECT name FROM ingredients ORDER BY name");
$stmt->execute();
echo "<script>ingredients.push(";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '"'.$row['name'].'",';
}
echo ")</script>";
?>
