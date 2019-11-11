<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
$email = $_SESSION['user']['email'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', hash("sha512", $password), PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_OBJ);
$row = $stmt->rowCount();

if ($row == 1) {
    echo "<script>$('#deleteConfirmModal').modal('toggle');</script>";
} else {
    echo "<div class=\"alert alert-danger\" style=\"margin: 5px 0; box-shadow: none\">Hibás jelszó!</div>";
}
