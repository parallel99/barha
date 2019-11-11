<?php
if (isset($_SESSION['user'])) {
    header("Location: /");
    die();
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <title>BárHa | Elfelejtett jelszó</title>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
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
        $Mail = new Mail($_POST['email'], $_POST['email'], "Új jelszó", "Új jelszó: " . $new_password);
        $Mail->Send();

        //ez csak ideiglenes
        echo "New password: " . $new_password;
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
    <form method="post" class="shadow" id="forgottenPasswordForm">
        <h1>Elfelejtett jelszó</h1>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" autocomplete="email" required>
        </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Elfelejtettem a jelszavam">
    </form>
</div>
</body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
