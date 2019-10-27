<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM ingredients WHERE LOWER(name) LIKE LOWER('%" . $search . "%') LIMIT 50;");
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', hash("sha512", $password), PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_OBJ);
$row = $stmt->rowCount();

if ($row == 1) {
    echo "<script>$('#deleteConfirmModal').modal('toggle');</script>";
} else {
    echo "<h1>Hibás jelszó!</h1>";
}

?>
