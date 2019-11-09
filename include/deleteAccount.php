<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
$email = $_SESSION['user']['email'];
$password = $_POST['password'];

$sql = "DELETE FROM users WHERE email = :email AND password = :password;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':password', hash('sha512', $_POST['password']));
$stmt->execute();
$details = $stmt->fetch();

if ($stmt->rowCount() == 0) {
    echo "<div class=\"alert alert-danger\">Hiba!</div>";
} else {
    unset($_SESSION['user']);
    setcookie("name", "", time() - 1, "/", "barha.herokuapp.com", 1, 1);
    setcookie("email", "", time() - 1, "/", "barha.herokuapp.com", 1, 1);
    echo "<script>document.location.href=\"/\";</script>";
    die();
}
