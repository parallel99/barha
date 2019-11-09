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
    <body>
        <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
            menu("login");
        ?>
        <div class="form-container">
            <form method="post" class="shadow" id="loginForm">
                <div class="form-group">
                    <label for="email">2 lépcsős hitelesítés</label>

                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" class="2-step-auth-number form-control" name="2-step-auth-number-1" id="2-step-auth-number-1" max="1" placeholder="" required>
                            <input type="text" class="2-step-auth-number form-control" name="2-step-auth-number-2" id="2-step-auth-number-2" max="1" placeholder="" required>
                            <input type="text" class="2-step-auth-number form-control" name="2-step-auth-number-3" id="2-step-auth-number-3" max="1" placeholder="" required>
                        </div>

                        <div class="col-sm-6">
                            <input type="text" class="2-step-auth-number form-control" name="2-step-auth-number-4" id="2-step-auth-number-4" max="1" placeholder="" required>
                            <input type="text" class="2-step-auth-number form-control" name="2-step-auth-number-5" id="2-step-auth-number-5" max="1" placeholder="" required>
                            <input type="text" class="2-step-auth-number form-control" name="2-step-auth-number-6" id="2-step-auth-number-6" max="1" placeholder="" required>
                        </div>
                    </div>
                    
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Bejelentkezés</button>
            </form>
        </div>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
