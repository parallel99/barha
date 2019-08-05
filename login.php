<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title></title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php'; ?>
        <div class="form-container">
            <form method="post" class="shadow" id="loginForm">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="password">Jelszó</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Jelszó">
                </div>
                <button type="submit" class="btn btn-primary">Bejelentkezés</button>
            </form>
        </div>
        <?php
            if(isset($_POST['submit'])) {

            }
        ?>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
