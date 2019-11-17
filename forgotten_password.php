<?php
if (isset($_SESSION['user'])) {
    header("Location: /");
    die();
}
?>
<!DOCTYPE html>
<html lang="<? echo $_SESSION["lang"] ?? "hu"; ?>">
<head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    <title><?= _BARHA ?> | Elfelejtett jelszó</title>
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
menu("none");
?>
<div class="form-container forgotten-password-container">
    <?php
    if (isset($_POST['submit'])) {
        include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';

        $new_password = generateRandomString(10);

        $sql = "UPDATE users SET new_password = :new_password WHERE email = :email;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        $stmt->bindValue(':new_password', hash("sha512", $new_password), PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_OBJ);

        if ($stmt->rowCount() == 0) {
            echo "<div class=\"alert alert-danger\" >Nincs ilyen email cím!</div>";
        }

        require_once($_SERVER['DOCUMENT_ROOT'] . '/include/mail-send.php');
        $Mail = new Mail($_POST['email'], $_POST['email'], _NEW_PASSWORD, _NEW_PASSWORD . ": " . $new_password);
        $Mail->Send();

        echo "<div class=\"alert alert-success\">Az új jelszót elküldtük emailben!</div>";
    }

    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@#%?.!*';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    ?>
    <form method="post" class="shadow mt-3" id="forgottenPasswordForm">
        <h1 class="h1 text-center mb-3">Elfelejtett jelszó</h1>
        <div class="form-group">
            <label for="email"><?= _EMAIL ?></label>
            <input type="email" class="form-control" name="email" id="email" placeholder="<?= _EMAIL ?>" autocomplete="email" required>
        </div>
        <input type="submit" class="btn btn-primary w-100 mt-2" name="submit" value="Elfelejtettem a jelszavam">
    </form>
</div>
</body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
