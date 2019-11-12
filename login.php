<?php
if (isset($_SESSION['user'])) {
    header("Location: /");
    die();
}
?>
<!DOCTYPE html>
<html lang="<? try {echo $_SESSION['user']['lang'];}catch (Exception $e){echo 'hu';} ?>">
<head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    <title><?= _BARHA ?> | <?= _LOGIN ?></title>
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
menu("login");
?>
<div class="form-container">
    <?php
    if (isset($_POST['submit'])) {
        $msg = login();
        if ($msg != "") {
            echo $msg;
        } else {
            header("Refresh: 0");
            die();
        }
        unset($msg);
    }
    ?>
    <form method="post" class="shadow" id="loginForm">
        <div class="form-group">
            <label for="email"><?= _EMAIL ?></label>
            <input type="email" class="form-control" name="email" id="email" placeholder="<?= _EMAIL ?>" value="<?php echo $_POST["email"] ?? ""; ?>" required>
        </div>
        <div class="form-group">
            <label for="password"><?= _PASSWORD ?></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="<?= _PASSWORD ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit"><?= _LOGIN ?></button>
        <a href="forgotten_password" class="small"><?= _FORGOT_PASSWORD ?></a>
    </form>
</div>
<?php
function login() {
    include($_SERVER['DOCUMENT_ROOT'] . '/include/db.php');

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password1 = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $password = hash('sha512', $password1);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email= :email AND (password = :password OR new_password = :password)");
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_OBJ);
    $row = $stmt->rowCount();

    $find_user = false;
    $valid = false;

    if ($row == 1) {
        $find_user = true;
        if ($user->active == 1 && $find_user) {
            //Ez meg nincs kész teljesen
            if (!isset($user->secret_key)) {
                $_SESSION['user'] = array('name' => $user->name, 'email' => $user->email, 'permission' => $user->permission, 'lang' => $user->lang);
                setcookie('userid', $user->id, time() + 5000000, "/", "barha.herokuapp.com", 1, 1);
                $valid = true;
            } else {
                $_SESSION['two-auth-user'] = array('name' => $user->name, 'email' => $user->email, 'permission' => $user->permission, 'secret' => $user->secret_key, 'id' => $user->id);
                header("Location: /two-factor.php");
            }
        }
    }

    $msg = "";

    if (!$find_user) {
        $msg = '<div class="alert alert-danger alert-dismissible fade show">Hibás email vagy jelszó!</div>';
    } elseif (!$valid) {
        $msg = '<div class="alert alert-danger alert-dismissible fade show">Még nem erősítette meg az email címét!</div>';
    }

    return $msg;
}

?>
</body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
