<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title></title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php'; ?>
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

            }
        ?>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
