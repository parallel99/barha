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

            //TODO megcsinalni ugy hogy a meglevo gombokat valtoztassa meg
            //TODO a modal-t attenni ebbe a fileba
            // ezt az egeszet át tervezem írni a hétvegén
            // --> sok sikert hozzá, én helyette kalkulus-szozok

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
        <h3><?= _CHANGE_LANG ?></h3>
        <?php
        if (isset($_POST['account-lang-change'])) {
            if($_POST['lang-select'] == "hu" || $_POST['lang-select'] == "en"){
                $_SESSION['lang'] = $_POST['lang-select'];
                include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';

                $stmt = $pdo->prepare("UPDATE users SET lang = :lang WHERE email = :email");
                $stmt->bindValue(':email', $_SESSION['user']['email'], PDO::PARAM_STR);
                $stmt->bindValue(':lang', $_POST['lang-select'], PDO::PARAM_STR);
                $stmt->execute();
                $data = $stmt->fetch(PDO::FETCH_OBJ);

                header("Refresh: 0");
          }
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
                    echo "<option value=\"hu\" selected>" . _HU . "</option>";
                    echo "<option value=\"en\">" . _EN . "</option>";
                } elseif ($data->lang == 'en') {
                    echo "<option value=\"hu\">" . _HU . "</option>";
                    echo "<option value=\"en\" selected>" . _EN . "</option>";
                } else {
                    echo "<option value=\"hu\">" . _HU . "</option>";
                    echo "<option value=\"en\">" . _EN . "</option>";
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

<!-- 2factorAuthModal -->
<div id="auth-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Google Authenticator</h5>
            </div>
            <div class="modal-body">
                Olvasd be a QR kódot a Google Authenticator alkalmazassal
                <?php
                echo "<img class=\"auth-qr-code\" src=" . $_SESSION['qrcode'] . " alt='Secret key'>";
                echo "<p class=\"auth-secret small text-muted\">" . $_SESSION['secret'] . "</p>";
                ?>
                <h4 class="download-google-authenticator-text">Még nincs letöltve?</h4>
                <h4 class="download-google-authenticator-text">Itt megteheted</h4>
                <div class="row">
                    <div class="col-6">
                        <a href='https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img
                                    alt='Szerezd meg: Google Play'
                                    src='https://play.google.com/intl/en_us/badges/static/images/badges/hu_badge_web_generic.png'/></a>
                    </div>
                    <div class="col-6">
                        <a href='https://apps.apple.com/us/app/google-authenticator/id388497605'><img
                                    alt='Szerezd meg: App Store' src='/images/download-with-app-store.svg'/></a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Mégsem</button>
                <button type="button" class="btn btn-primary" name="saveSecretKey" id="saveSecretKey"
                        data-dismiss="modal">Kész
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $("#enable-2-step-auth").click(function () {
        $('#auth-modal').modal('toggle');
        $("body").css("padding-right", "0");

        $("#saveSecretKey").click(function () {
            $("#enable-2-step-auth").remove();
            $.ajax({
                url: 'include/saveSecretKey.php',
                type: 'post',
                data: {},
                success: function () {
                },
                error: function () {
                }
            });
            $('.account-2-step-auth-form').append("<input type=\"button\" class=\"btn btn-danger\" id=\"disable-2-step-auth\" value=\"Engedélyezve🎉\">");
            $("#disable-2-step-auth")
                .mouseover(function () {
                    $("#disable-2-step-auth").val("Kikapcsolás");
                })
                .mouseout(function () {
                    $("#disable-2-step-auth").val("Engedélyezve🎉");
                });
        });
    });
</script>

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
