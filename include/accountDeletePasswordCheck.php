<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_OBJ);
$row = $stmt->rowCount();

if ($row == 1) {
    echo "<script>$('#deleteConfirmModal').modal('toggle');</script>";
} else {
    echo "<h1>Hibás jelszó</h1>";
}
?>
