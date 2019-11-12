<?php
if (!isset($_SESSION['user'])) {
    header("Location: /");
    die();
}
?>
<!DOCTYPE html>
<html lang="<? echo $_SESSION["lang"] ?? "hu"; ?>">
<head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    <title><?= _BARHA ?> | <?= _PROFILE?></title>
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
menu("profile");
?>
<div class="account container shadow">
    <form method="POST" class="account-2-step-auth-form">
        <h3><?= _2_STEP_AUTH ?></h3>
        <div class="form-group">
            <?php

            include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';

            $stmt = $pdo->prepare("SELECT secret_key FROM users WHERE email = :email");
            $stmt->bindValue(':email', $_SESSION['user']['email'], PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ);

            if (isset($data->secret_key)) {
                echo "<input type=\"button\" class=\"btn btn-primary\" id=\"disable-2-step-auth\" value=\"Engedélyezve🎉\">";
            } else {
                echo "<input type=\"button\" class=\"btn btn-primary\" id=\"enable-2-step-auth\" value=\"Engedélyezés\">";
            }
            ?>
        </div>
        <script>
            $("#enable-2-step-auth").click(function () {
                $.ajax({
                    url: 'include/twoFactorAuthentication.php',
                    type: 'post',
                    data: {},
                    success: function (response) {
                        $('.account-2-step-auth-form').append(response)
                    },
                    error: function () {}
                });
            });
            $("#disable-2-step-auth").click(function () {
                $.ajax({
                    url: 'include/disableTwoFactorAuthentication.php',
                    type: 'post',
                    data: {},
                    success: function (response) {
                        $('.account-2-step-auth-form').append(response)
                    },
                    error: function () {}
                });
            });
        </script>
    </form>
    <script>
        $("#disable-2-step-auth")
            .mouseover(function () {
                $("#disable-2-step-auth").val("Kikapcsolás");
            })
            .mouseout(function () {
                $("#disable-2-step-auth").val("Engedélyezve🎉");
            });
    </script>
    <hr>
    <form method="POST" class="account-lang-change-form">
        <h3>Nyelv váltás</h3>
        <?php
        if (isset($_POST['account-lang-change'])) {
            $_SESSION['user']['lang'] = $_POST['lang-select'];

            include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';

            $stmt = $pdo->prepare("UPDATE users SET lang = :lang WHERE email = :email");
            $stmt->bindValue(':email', $_SESSION['user']['email'], PDO::PARAM_STR);
            $stmt->bindValue(':lang', $_POST['lang-select'], PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ);

            header("Refresh: 0");
        }
        ?>
        <div class="form-group">
            <select class="custom-select form-control" name="lang-select" id="lang-select">
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';

                $stmt = $pdo->prepare("SELECT lang FROM users WHERE email = :email");
                $stmt->bindValue(':email', $_SESSION['user']['email'], PDO::PARAM_STR);
                $stmt->execute();
                $data = $stmt->fetch(PDO::FETCH_OBJ);

                if ($data->lang == 'hu') {
                    echo "<option value=\"hu\" selected>Magyar</option>";
                    echo "<option value=\"en\">Angol</option>";
                } elseif ($data->lang == 'en') {
                    echo "<option value=\"hu\">Magyar</option>";
                    echo "<option value=\"en\" selected>Angol</option>";
                } else {
                    echo "<option value=\"hu\">Magyar</option>";
                    echo "<option value=\"en\">Angol</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" name="account-lang-change" class="btn btn-primary"><?= _SAVE ?></button>
    </form>
    <hr>
    <form method="POST" class="account-password-change-form">
        <h3><?= _CHANGE_PASSWORD ?></h3>
        <div class="form-group">
            <label for="passwordCurrent"><?= _CURRENT_PASSWORD ?></label>
            <input required type="password" name="passwordCurrent" id="passwordCurrent" minlength="4" maxlength="255" class="form-control" autocomplete="off" placeholder="<?= _CURRENT_PASSWORD ?>">
        </div>
        <div class="form-group">
            <label for="passwordNew1"><?= _NEW_PASSWORD ?></label>
            <input required type="password" name="passwordNew1" id="passwordNew1" minlength="4" maxlength="255" class="form-control" autocomplete="off" placeholder="<?= _NEW_PASSWORD ?>">
        </div>
        <div class="form-group">
            <label for="passwordNew2"><?= _CONFIRM_NEW_PASSWORD ?></label>
            <input required type="password" name="passwordNew2" id="passwordNew2" minlength="4" maxlength="255" class="form-control" autocomplete="off" placeholder="<?= _CONFIRM_NEW_PASSWORD ?>">
        </div>
        <button type="submit" name="account-password-change" class="btn btn-primary"><?= _SAVE ?></button>
    </form>
    <hr>
    <form method="POST" class="account-email-change-form">
        <h3><?= _CHANGE_EMAIL ?></h3>
        <div class="form-group">
            <label for="emailNew"><?= _NEW_EMAIL ?></label>
            <input required type="text" name="emailNew" id="emailNew" minlength="4" maxlength="255" class="form-control" autocomplete="off" placeholder="<?= _NEW_EMAIL ?>">
        </div>
        <div class="form-group">
            <label for="password"><?= _PASSWORD ?></label>
            <input required type="password" name="password" id="password" minlength="4" maxlength="255" class="form-control" autocomplete="off" placeholder="<?= _PASSWORD ?>">
        </div>
        <button type="submit" name="account-email-change" class="btn btn-primary"><?= _SAVE ?></button>
    </form>
    <hr>
    <form method="POST" class="account-delete-form">
        <h3><?= _DELETE_ACCOUNT ?></h3>
        <div class="account-delete-error-container"></div>
        <div class="form-group">
            <label for="password"><?= _PASSWORD ?></label>
            <input required type="password" name="password" id="passwordDA" maxlength="255" class="form-control" placeholder="<?= _PASSWORD ?>" autocomplete="off">
        </div>
        <button type="button" name="account-delete" id="account-delete" class="btn btn-danger"><?= _DELETE_ACCOUNT ?></button>
    </form>
</div>
<!-- deleteConfirmModal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= _DELETE_ACCOUNT ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="<?= _CANCEL ?>">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Biztos benne hogy törölni szeretné a fiókját? Ezek után a fiók soha többé nem lesz visszaállítható.
            </div>
            <div class="modal-footer">
                <button type="button" id="modal-delete-cancel" class="btn btn-secondary" data-dismiss="modal"><?= _CANCEL ?></button>
                <button type="button" id="modal-delete" class="btn btn-danger"><?= _YES ?></button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#account-delete").click(function () {
        $('.account-delete-error-container .alert').remove();
        $.ajax({
            url: 'include/accountDeletePasswordCheck.php',
            type: 'post',
            data: {
                "password": $("#passwordDA").val()
            },
            success: function (response) {
                $('.account-delete-error-container').append(response)
            },
            error: function () {}
        });
    });

    $("#modal-delete-cancel").click(function () {
        $("#passwordDA").val("");
    });

    $("#modal-delete").click(function () {
        $.ajax({
            url: 'include/deleteAccount.php',
            type: 'post',
            data: {
                "password": $("#passwordDA").val()
            },
            success: function (response) {
                $('.account-delete-error-container').append(response);
            },
            error: function () {}
        });
    });
</script>
</body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
