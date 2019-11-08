<?php
if (!isset($_SESSION['user'])) {
    header("Location: /");
    die();
}
?>
<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title>BárHa | Profil</title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
        menu("profile");
        echo "<h6 style=\"display: none\" id=\"email\">" . $_SESSION['user']['email'] . "</h6>";
        ?>
        <div class="account container shadow">
            <form method="POST" class="account-2-step-auth-form">
                <h3>2 lépcsős hitelesítés</h3>
                <div class="form-group">
                    <input type="button" class="btn btn-primary" id="enable-2-step-auth" value="Engedélyezése">
                </div>
                <script>
                $("#enable-2-step-auth").click(function() {
                    $("#enable-2-step-auth").hide();
                    $.ajax({
                    url: 'include/twoFactorAuthentication.php',
                            type: 'post',
                            data: {
                                "email": $('#email').text()
                            },
                            success: function (response) {
                                $('.account-2-step-auth-form').append(response)
                            },
                            error: function (data) {}
                    });
                });
                </script>
            </form>
            <hr>
            <form method="POST" class="account-lang-change-form">
                <h3>Nyelv váltás</h3>
                <div class="form-group">
                    <label for="lang-select">Nyelv</label>
                    <select class="form-control" id="lang-select">
                        <option>Magyar</option>
                        <option>Angol</option>
                    </select>
                </div>
                <button type="submit" name="account-lang-change" class="btn btn-primary">Mentés</button>
                <?php
                if (isset($_POST['account-lang-change'])) {
                    echo "Ne nyomkodd!";
                }
                ?>
            </form>
            <hr>
            <form method="POST" class="account-password-change-form">
                <h3>Jelszó váltás</h3>
                <div class="form-group">
                    <label for="passwordCurrent">Jelenlegi jelszó</label>
                    <input required type="password" name="passwordCurrent" id="passwordCurrent" minlength="4" maxlength="255" class="form-control" autocomplete="off" placeholder="Jelenlegi jelszó">
                </div>
                <div class="form-group">
                    <label for="passwordNew1">Új jelszó</label>
                    <input required type="password" name="passwordNew1" id="passwordNew1" minlength="4" maxlength="255" class="form-control" autocomplete="off" placeholder="Új jelszó">
                </div>
                <div class="form-group">
                    <label for="passwordNew2">Új jelszó megerősítése</label>
                    <input required type="password" name="passwordNew2" id="passwordNew2" minlength="4" maxlength="255" class="form-control" autocomplete="off" placeholder="Új jelszó megerősítése">
                </div>
                <button type="submit" name="account-password-change" class="btn btn-primary">Jelszó váltás</button>
            </form>
            <hr>
            <form method="POST" class="account-email-change-form">
                <h3>Email cím váltás</h3>
                <div class="form-group">
                    <label for="emailNew">Új email cím</label>
                    <input required type="text" name="emailNew" id="emailNew" minlength="4" maxlength="255" class="form-control" autocomplete="off" placeholder="Új email cím">
                </div>
                <div class="form-group">
                    <label for="password">Jelszó</label>
                    <input required type="password" name="password" id="password" minlength="4" maxlength="255" class="form-control" autocomplete="off" placeholder="Jelszó">
                </div>
                <button type="submit" name="account-email-change" class="btn btn-primary">Email cím váltás</button>
            </form>
            <hr>
            <form method="POST" class="account-delete-form">
                <h3>Fiók törlése</h3>
                <div class="form-group">
                    <label for="password">Jelszó</label>
                    <input required type="password" name="password" id="passwordDA" maxlength="255" class="form-control" placeholder="Jelszó" autocomplete="off">
                </div>
                <button type="button" name="account-delete" id="account-delete" class="btn btn-danger">Fiók törlése</button>
            </form>
        </div>
        <!-- deleteConfirmModal -->
        <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Fiók törlése</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Biztos benne hogy törölni szeretné a fiókját? Ezek után a fiók soha többé nem lesz visszaállítható.
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="modal-delete-cancel" class="btn btn-secondary" data-dismiss="modal">Mégsem</button>
                        <button type="button" id="modal-delete" class="btn btn-danger">Igen</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $("#account-delete").click(function() {
                $.ajax({
                url: 'include/accountDeletePasswordCheck.php',
                        type: 'post',
                        data: {
                            "email": $('#email').text(),
                            "password": $("#passwordDA").val()
                        },
                        success: function (response) {
                            $('html').append(response)
                        },
                        error: function (data) {}
                });
            });

            $("#modal-delete-cancel").click(function() {
                $("#passwordDA").val("");
            });

            $("#modal-delete").click(function() {
                $.ajax({
                url: 'include/deleteAccount.php',
                        type: 'post',
                        data: {
                            "email": $('#email').text(),
                            "password": $("#passwordDA").val()
                        },
                        success: function (response) {
                            $('html').append(response);
                        },
                        error: function (data) {}
                });
            });
        </script>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
