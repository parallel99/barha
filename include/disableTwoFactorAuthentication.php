<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
$email = $_SESSION['user']['email'];

$stmt = $pdo->prepare("UPDATE users SET secret_key = null WHERE email = :email");
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_OBJ);

echo "<input type=\"button\" class=\"btn btn-success\" id=\"enable-2-step-auth\" value=\"Engedélyezés\"><script>$(\"#disable-2-step-auth\").remove()</script>";

echo '<script>$("#disable-2-step-auth").attr("value", "Engedélyezés");</script>';
echo '<script>$("#disable-2-step-auth").attr("id", "enable-2-step-auth");</script>';
