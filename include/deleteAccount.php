<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "DELETE FROM users WHERE email = :email AND password = :password;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':password', hash('sha512', $_POST['password']));
$stmt->execute();
$details = $stmt->fetch();

if ($stmt->rowCount() == 0) {
    echo "<div class=\"alert alert-danger\">Na-na!</div>";
} else {
    session_destroy();

    header("Location: /");
    die();
}


?>
