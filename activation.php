<?php
if (!isset($_GET["id"])) {
    header("Location: /");
    die();
}

include($_SERVER['DOCUMENT_ROOT'] . '/include/db.php');


$stmt = $pdo->prepare("SELECT * FROM users WHERE token = :token");
$stmt->bindValue(':token', $_GET["id"], PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->rowCount();
$user = $stmt->fetch(PDO::FETCH_OBJ);

if ($row == 1) {
    if ($user->active == 1) {
        $volt = true;
    } else {
        $volt = false;
        $activate = $pdo->prepare("UPDATE users SET active = '1' WHERE token = :token");
        $activate->bindValue(':token', $_GET["id"], PDO::PARAM_STR);
        $activate->execute();
    }
}
?>
<!DOCTYPE html>
<html lang="<? echo $_SESSION["lang"] ?? "hu"; ?>">
<head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    <title><?= _BARHA ?> | <?= _EMAIL_CONFIRM ?></title>
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
menu("none");
?>
<div class="form-container">
    <div class="shadow email-confirm activation">
        <?php
        if (isset($volt)) {
            if ($volt) {
                echo "<h1>" . _UNSUCCESSFUL_CONFIRMATION . "</h1><hr>";
                echo "<p>" . _ALREADY_CONFIRMED . "</p>";
            } else {
                echo "<h1>" . _SUCCESSFUL_CONFIRMATION . "</h1><hr>";
                echo "<p>" . _REG_SUCCESSFULLY_CONFIRMED . "</p>";
            }
        } else {
            echo "<h1>" . _UNSUCCESSFUL_CONFIRMATION . "</h1><hr>";
            echo "<p>" . _INVALID_LINK . "</p>";
        }
        ?>
        <hr>
        <div>
            <a href="/" class="btn btn-primary"><?= _HOMEPAGE ?></a>
        </div>
    </div>
</div>
</body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
