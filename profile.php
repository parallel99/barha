<?php
/*if(!isset($_SESSION['user'])){
    header("Location: /");
    die();
}*/
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
            <div class="account shadow container">
                <form method="POST" class="account-password-change-form">
                    <h3>Jelszó váltás</h3>
                    <div class="form-group">
                        <label for="passwordCurrent">Jelenlegi jelszó</label>
                        <input required type="password" name="passwordCurrent" id="passwordCurrent" minlength="4" maxlength="255" class="form-control" autocomplete="current-password" placeholder="Jelenlegi jelszó">
                    </div>
                    <div class="form-group">
                        <label for="passwordNew1">Új jelszó</label>
                        <input required type="password" name="passwordNew1" id="passwordNew1" minlength="4" maxlength="255" class="form-control" autocomplete="new-password" placeholder="Új jelszó">
                    </div>
                    <div class="form-group">
                        <label for="passwordNew2">Új jelszó megerősítése</label>
                        <input required type="password" name="passwordNew2" id="passwordNew2" minlength="4" maxlength="255" class="form-control" autocomplete="new-password" placeholder="Új jelszó megerősítése">
                    </div>
                    <button type="submit" name="account-password-change" class="btn btn-primary">Jelszó váltás</button>
                </form>
                <hr>
                <form method="POST" class="account-username-change-form">
                    <h3>Change username(nincs is username)</h3>
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
                    <h3>Fiók törlése</h3>
                    <div class="form-group">
                        <label for="password">Jelszó</label>
                        <input required type="password" name="password" id="passwordDA" minlength="4" maxlength="255" class="form-control" autocomplete="current-password" placeholder="Jelszó">
                    </div>
                    <button type="submit" name="account-delete" class="btn btn-danger">Fiók törlése</button>
                </form>
            </div>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
