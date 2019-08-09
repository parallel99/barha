<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title></title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php'; ?>
        <div class="form-container">
            <form method="post" class="shadow" id="registrationForm">
                <div class="form-group">
                    <label for="name">Név</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Név">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="password1">Jelszó</label>
                    <input type="password" class="form-control" name="password1" id="password1" placeholder="Jelszó">
                </div>
                <div class="form-group">
                    <label for="password2">Jelszó megerősítése</label>
                    <input type="password" class="form-control" name="password2" id="password2" placeholder="Jelszó megerősítése">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="aszf" name="aszf">
                    <label class="form-check-label" for="aszf">
                        Elfogadom <a href="#">Felhasználási feltételeket</a>.
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Regisztráció</button>
            </form>
        </div>
        <?php
            if(isset($_POST['submit'])) {

            }
        ?>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
