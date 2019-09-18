<?php
if(isset($_SESSION['user'])){
    header("Location: /");
    die();
}
?>
<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title></title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body>
        <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
            menu("login");
        ?>
        <div class="form-container forgotten-password-container">
            <form method="post" class="shadow" id="forgottenPasswordForm">
                <h1>Elfelejtett jelszó</h1>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                </div>
                <button type="submit" class="btn btn-primary">Elfelejtettem a jelszavam</button>
            </form>
        </div>
        <?php
            if(isset($_POST['submit'])) {
                try {
                require 'vendor/autoload.php';
                $email = new \SendGrid\Mail\Mail();
                $email->setFrom("mateb06@gmail.com", "Étel segéd");
                $email->setSubject("Étel segéd teszt");
                $email->addTo($_POST['email'], "teszt");
                $email->addContent(
                    "text/html", "<strong>Étel segéd</strong> teszt"
                );
                $sendgrid = new \SendGrid('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');
                    $response = $sendgrid->send($email);
                } catch (Exception $e) {
                    echo 'Caught exception: ',  $e->getMessage(), "\n";
                }
            }
        ?>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
