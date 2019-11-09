<?php
if (isset($_SESSION['user'])) {
    header("Location: /");
    die();
}
?>
<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title>BárHa | Bejelentkezés</title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body id="two-factor-body">
        <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
            menu("login");
        ?>
        <div class="form-container">
            <?php
            if (isset($_POST['submit'])) {
                require 'vendor/autoload.php';
                $authenticator = new PHPGangsta_GoogleAuthenticator();
                $secret = '7RH77J45GIYX6TIZ';
                $otp = $_POST["2-step-auth-number-1"].$_POST["2-step-auth-number-2"].$_POST["2-step-auth-number-3"].$_POST["2-step-auth-number-4"].$_POST["2-step-auth-number-5"].$_POST["2-step-auth-number-6"];

                $tolerance = 2;//2*30sec

                $checkResult = $authenticator->verifyCode($secret, $otp, $tolerance);

                if ($checkResult) {
                    echo '<div class="alert alert-success" role="alert">Sikeres bejelentkezés</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Hiba</div>';
                }
            }
            ?>
            <form method="post" class="shadow" id="two-factor-form">
                <div class="form-group">
                    <h3 class="h3">2 lépcsős hitelesítés</h3>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <div class="row d-flex justify-content-end" id="left">
                                <input type="number" pattern="[0-9]*" class="two-step-auth-number form-control col-sm-2" name="2-step-auth-number-1" id="2-step-auth-number-1" maxlength="1" size="1" placeholder="" required autofocus>
                                <input type="number" pattern="[0-9]*" class="two-step-auth-number form-control col-sm-2" name="2-step-auth-number-2" id="2-step-auth-number-2" maxlength="1" size="1" placeholder="" required>
                                <input type="number" pattern="[0-9]*" class="two-step-auth-number form-control col-sm-2" name="2-step-auth-number-3" id="2-step-auth-number-3" maxlength="1" size="1" placeholder="" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="row d-flex justify-content-start" id="right">
                                <input type="number" pattern="[0-9]*" class="two-step-auth-number form-control col-sm-2" name="2-step-auth-number-4" id="2-step-auth-number-4" maxlength="1" size="1" placeholder="" required>
                                <input type="number" pattern="[0-9]*" class="two-step-auth-number form-control col-sm-2" name="2-step-auth-number-5" id="2-step-auth-number-5" maxlength="1" size="1" placeholder="" required>
                                <input type="number" pattern="[0-9]*" class="two-step-auth-number form-control col-sm-2" name="2-step-auth-number-6" id="2-step-auth-number-6" maxlength="1" size="1" placeholder="" required>
                            </div>
                        </div>
                    </div>
                    <script>
                    $('body').on('keyup', '.two-step-auth-number', function(){
                        if($(this).val().length === this.size){
                            var inputs = $('.two-step-auth-number');
                            inputs.eq(inputs.index(this) + 1).focus();
                        }
                    });
                    </script>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary" name="submit">Bejelentkezés</button>
            </form>
        </div>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
