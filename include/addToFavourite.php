<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
$id = $_POST['id'];
$email = $_SESSION['user']['email'];

$getrecipe = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
$getrecipe->bindParam(':id', $id, PDO::PARAM_INT);
$getrecipe->execute();

if($getrecipe->rowCount() > 0){
    $stmt = $pdo->prepare("UPDATE users SET favourite = favourite || :id WHERE email = :email AND ( :id != ALL(favourite) OR favourite IS NULL);");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
}
?>
