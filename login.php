<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title></title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/navbar.php'; ?>
        <form method="post" class="shadow">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
            <button type="submit" class="btn btn-primary">Bejelentkezés</button>
        </form>
        <?php
            if(isset($_POST['submit'])) {

            }
        ?>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>
</html>
