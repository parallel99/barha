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
        <div class="form-container">
            <form method="post" class="shadow" id="forgottenPasswordForm">
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
                // Comment out the above line if not using Composer
                $email = new \SendGrid\Mail\Mail();
                $email->setFrom("mateb06@gmail.com", "Étel segéd");
                $email->setSubject("Étel segéd teszt");
                $email->addTo($_POST['email'], "teszt");
                $email->addContent(
                    "text/html", "<strong>Étel segéd</strong> teszt"
                );
                $sendgrid = new \SendGrid('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');
                    $response = $sendgrid->send($email);
                    print $response->statusCode() . "\n";
                    print_r($response->headers());
                    print $response->body() . "\n";
                } catch (Exception $e) {
                    echo 'Caught exception: ',  $e->getMessage(), "\n";
                }
            }
        ?>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
