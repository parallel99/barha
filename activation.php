<?php
if (!isset($_GET["id"])) {
    header("Location: /");
    die();
}

include ($_SERVER['DOCUMENT_ROOT'] . '/include/db.php');


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
<html lang="hu" role="main">
    <head>
        <title>E-mail megerősítés</title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body class="activation-body">
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
        menu("none");
        ?>
        <div class="form-container activation-container">
            <div class="shadow activation">
                <?php
                if (isset($volt)) {
                    if ($volt) {
                        echo "<h1>Sikertelen megerősítés</h1><hr>";
                        echo "<p>A megerősítés már megtörtént!</p>";
                    } else {
                        echo "<h1>Sikeres megerősítés</h1><hr>";
                        echo "<p>Sikeresen megerősítette a regisztrációt!</p>";
                    }
                } else {
                    echo "<h1>Sikertelen megerősítés</h1><hr>";
                    echo "<p>Érvénytelen link!</p>";
                }
                ?>
                <hr>
                <div>
                    <a href="/" class="btn btn-primary">Főoldal</a>
                </div>
            </div>
        </div>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
