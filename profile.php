<?php
if(!isset($_SESSION['user'])){
    header("Location: /");
    die();
}
?>
<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title>Étel-segéd | Profil</title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body>
        <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
            menu("profile");
        ?>
        <div class="container shadow">
            <div class="account">
                <form method="POST" class="account-password-change-form">
                    <h3>Change password</h3>
                    <div class="form-group">
                        <label for="passwordCurrent">Current password</label>
                        <input required type="password" name="passwordCurrent" id="passwordCurrent" minlength="4" maxlength="255" class="form-control" autocomplete="current-password" placeholder="Current password">
                    </div>
                    <div class="form-group">
                        <label for="passwordNew1">New password</label>
                        <input required type="password" name="passwordNew1" id="passwordNew1" minlength="4" maxlength="255" class="form-control" autocomplete="new-password" placeholder="New password">
                    </div>
                    <div class="form-group">
                        <label for="passwordNew2">Confirm new password</label>
                        <input required type="password" name="passwordNew2" id="passwordNew2" minlength="4" maxlength="255" class="form-control" autocomplete="new-password" placeholder="Confirm new password">
                    </div>
                    <button type="submit" name="account-password-change" class="btn btn-primary">Change password</button>
                </form>
                <hr>
                <form method="POST" class="account-username-change-form">
                    <h3>Change username</h3>
                    <div class="form-group">
                        <label for="usernameNew">New username</label>
                        <input required type="text" name="usernameNew" id="usernameNew" minlength="4" maxlength="255" class="form-control" autocomplete="username" placeholder="New username">
                    </div>
                    <div class="form-group">
                        <label for="password">Jelszó</label>
                        <input required type="password" name="password" id="password" minlength="4" maxlength="255" class="form-control" autocomplete="current-password" placeholder="Password">
                    </div>
                    <button type="submit" name="account-username-change" class="btn btn-primary">Change username</button>
                </form>
                <hr>
                <form method="POST" class="account-delete-form">
                    <h3>Delete account</h3>
                    <div class="form-group">
                        <label for="password">Jelszó</label>
                        <input required type="password" name="password" id="passwordDA" minlength="4" maxlength="255" class="form-control" autocomplete="current-password" placeholder="Password">
                    </div>
                    <button type="submit" name="account-delete" class="btn btn-danger">Delete account</button>
                </form>
            </div>
        </div>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
