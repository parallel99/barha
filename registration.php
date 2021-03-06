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
    <title><?= _BARHA ?> | <?= _REGISTER ?></title>
    <!-- recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js?explicit&hl=<?= _LANG ?>" async defer></script>
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
menu("registration");

if (isset($_POST['submit'])) {
    $msg = registration();
    echo $msg;
    unset($msg);
}
?>
<form method="post" class="shadow mt-3" id="registrationForm">
    <div class="form-group">
        <label for="name"><?= _NAME ?></label>
        <input type="text" class="form-control" name="name" id="name" value="<?php echo $_POST["name"] ?? ""; ?>" placeholder="<?= _NAME ?>" required>
    </div>
    <div class="form-group">
        <label for="email"><?= _EMAIL ?></label>
        <input type="email" class="form-control" name="email" id="email"
               value="<?php echo $_POST["email"] ?? ""; ?>" placeholder="<?= _EMAIL ?>" required>
    </div>
    <div class="form-group">
        <label for="password1"><?= _PASSWORD ?></label>
        <input type="password" class="form-control" name="password1" id="password1" placeholder="<?= _PASSWORD ?>" required>
    </div>
    <div class="form-group">
        <label for="password2"><?= _PASSWORD_CONFIRM ?></label>
        <input type="password" class="form-control" name="password2" id="password2" placeholder="<?= _PASSWORD_CONFIRM ?>" required>
    </div>
    <div class="form-group">
        <label for="lang-select"><?= _LANGUAGE ?></label>
        <select class="custom-select form-control" name="lang-select" id="lang-select" required>
            <option value="hu"><?= _HU ?></option>
            <option value="en"><?= _EN ?></option>
        </select>
    </div>
    <div class="form-group g-recaptcha-container text-center">
        <div class="g-recaptcha" data-sitekey="6LfJWrgUAAAAAF-KDdVddakovbfI8KLip_99UOw-"></div>
    </div>
    <div class="form-check mb-3">
        <div class="custom-control custom-checkbox form-check-input">
            <input type="checkbox" class="custom-control-input" id="aszf" name="aszf" required>
            <label class="custom-control-label" for="aszf"></label>
        </div>
        <label class="form-check-label small" for="aszf">
            <?= _ACCEPT_OUR ?>
        </label>
        <div class="aszf small" data-toggle="modal" data-target="#aszfModal"><?= _T_AND_P ?></div>
        <label class="form-check-label small" for="aszf">
            .
        </label>
    </div>

    <button type="submit" name="submit" class="btn btn-primary w-100"><?= _REGISTER ?></button>
</form>
<!-- felhasználási feltételek modal -->
<div class="modal fade bd-example-modal-lg" id="aszfModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?= _T_AND_P2 ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="<?= _CLOSE ?>">&times;</button>
            </div>
            <div class="modal-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu magna tellus. Duis ac lectus ac
                    diam placerat vehicula id at neque. Suspendisse et consequat leo, vel euismod tortor. Phasellus
                    sagittis purus vel nibh laoreet aliquam. Quisque lacinia, ipsum vel finibus fringilla, orci nunc
                    vulputate leo, et faucibus arcu magna a orci. Donec aliquam nunc dolor. Sed erat quam, tempor quis
                    maximus vel, vestibulum tristique nisl. Fusce finibus, leo ut venenatis bibendum, enim justo dictum
                    sapien, at vehicula augue massa a purus. Nam pretium lacus sed nunc posuere, sed lacinia neque
                    sodales. Sed efficitur dui et nulla vestibulum dapibus. Sed fringilla elit porta leo euismod
                    tincidunt. Sed consectetur suscipit nisi, quis viverra eros egestas luctus. Etiam vel ornare velit,
                    non tincidunt risus. Cras a velit quam. Curabitur gravida urna in fermentum sagittis. Praesent
                    dignissim et quam sagittis euismod.
                </p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu magna tellus. Duis ac lectus ac
                    diam placerat vehicula id at neque. Suspendisse et consequat leo, vel euismod tortor. Phasellus
                    sagittis purus vel nibh laoreet aliquam. Quisque lacinia, ipsum vel finibus fringilla, orci nunc
                    vulputate leo, et faucibus arcu magna a orci. Donec aliquam nunc dolor. Sed erat quam, tempor quis
                    maximus vel, vestibulum tristique nisl. Fusce finibus, leo ut venenatis bibendum, enim justo dictum
                    sapien, at vehicula augue massa a purus. Nam pretium lacus sed nunc posuere, sed lacinia neque
                    sodales. Sed efficitur dui et nulla vestibulum dapibus. Sed fringilla elit porta leo euismod
                    tincidunt. Sed consectetur suscipit nisi, quis viverra eros egestas luctus. Etiam vel ornare velit,
                    non tincidunt risus. Cras a velit quam. Curabitur gravida urna in fermentum sagittis. Praesent
                    dignissim et quam sagittis euismod.
                </p>
                <p>A miénk lesz a veséd IS.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><?= _CLOSE ?></button>
            </div>
        </div>
    </div>
</div>
<?php

function registration() {
    $msg = "";
    $ok = true;

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password1 = filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_STRING);
    $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING);
    $lang = filter_input(INPUT_POST, 'lang-select', FILTER_SANITIZE_STRING);

    $captcha = $_POST['g-recaptcha-response'];
    $secretKey = getenv("GOOGLE_RECAPTCHA_SECRET_KEY");
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) . '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKeys = json_decode($response, true);

    if (!$responseKeys["success"]) {//TODO ide ki kell talani valamit (google recaptcha)
        $msg .= '<div class="alert alert-danger alert-dismissible fade show">' . _SIGN_UP_ERROR_0 . '</div>';
        $ok = false;
    }

    if (!filter_has_var(INPUT_POST, 'aszf')) {
        $msg .= '<div class="alert alert-danger alert-dismissible fade show">' . _SIGN_UP_ERROR_1 . '</div>';
        $ok = false;
    }

    if ($password1 != $password2) {
        $msg .= '<div class="alert alert-danger alert-dismissible fade show">' . _SIGN_UP_ERROR_2 . '</div>';
        $ok = false;
    }

    if (mb_strlen($name) < 4) {
        $msg .= '<div class="alert alert-danger alert-dismissible fade show">' . _SIGN_UP_ERROR_3 . '</div>';
        $ok = false;
    }

    if (mb_strlen($name) > 255) {
        $msg .= '<div class="alert alert-danger alert-dismissible fade show">' . _SIGN_UP_ERROR_4 . '</div>';
        $ok = false;
    }

    if (mb_strlen($email) < 4) {
        $msg .= '<div class="alert alert-danger alert-dismissible fade show">' . _SIGN_UP_ERROR_5 . '</div>';
        $ok = false;
    }

    if (mb_strlen($email) > 512) {
        $msg .= '<div class="alert alert-danger alert-dismissible fade show">' . _SIGN_UP_ERROR_6 . '</div>';
        $ok = false;
    }

    if (mb_strlen($password1) < 4) {
        $msg .= '<div class="alert alert-danger alert-dismissible fade show">' . _SIGN_UP_ERROR_7 . '</div>';
        $ok = false;
    }

    if (mb_strlen($password1) > 255) {
        $msg .= '<div class="alert alert-danger alert-dismissible fade show">' . _SIGN_UP_ERROR_8 . '</div>';
        $ok = false;
    }

    if ($lang != "hu" && $lang != "en") {
        $msg .= '<div class="alert alert-danger alert-dismissible fade show">' . _SIGN_UP_ERROR_9 . '</div>';
        $ok = false;
    }

    include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';

    $getemail = $pdo->prepare("SELECT * FROM users WHERE email = :email;");
    $getemail->bindValue(':email', $email, PDO::PARAM_STR);
    $getemail->execute();
    $row = $getemail->rowCount();

    if ($row > 0) {
        $msg .= '<div class="alert alert-danger alert-dismissible fade show">' . _SIGN_UP_ERROR_10 . '</div>';
        $ok = false;
    }

    if ($ok) {
        $random = mt_rand(10, 1000);
        $ticket = $email . $random;
        $password = hash('sha512', $password1);
        $token = hash('sha512', $ticket);
        $reg_time = date('Y-m-d H:i:s');

        $stmt = $pdo->prepare("INSERT INTO users(name, email, password, token, active, reg_time, lang, permission) VALUES (:name, :email, :password, :token, '0', :reg_time, :lang, 'user')");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->bindParam(':reg_time', $reg_time, PDO::PARAM_STR);
        $stmt->bindParam(':lang', $lang, PDO::PARAM_STR);
        $stmt->execute();

        require_once($_SERVER['DOCUMENT_ROOT'] . '/include/mail-send.php');
        require_once($_SERVER['DOCUMENT_ROOT'] . '/include/mailconfirm.php');
        $Mail = new Mail($name, $email, "E-mail megerősítés", confirm($name, $token));
        $Mail->Send();

        $msg = '<div class="alert alert-success alert-dismissible fade show">' . _SUCCESSFUL_SIGN_UP . '</div>';
        $_POST = array();
        unset($_POST);
    }

    return $msg;
}

?>
</body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
