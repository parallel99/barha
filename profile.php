<?php
/* if(!isset($_SESSION['user'])){
  header("Location: /");
  die();
  } */
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
        echo "<h6 style=\"display: none\" id=\"email\">" . $_SESSION['user']['email'] . "</h6>";
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
            <form method="POST" class="account-email-change-form">
                <h3>Email cím váltás</h3>
                <div class="form-group">
                    <label for="emailNew">Új email cím</label>
                    <input required type="text" name="emailNew" id="emailNew" minlength="4" maxlength="255" class="form-control" autocomplete="email" placeholder="Új email cím">
                </div>
                <div class="form-group">
                    <label for="password">Jelszó</label>
                    <input required type="password" name="password" id="password" minlength="4" maxlength="255" class="form-control" autocomplete="current-password" placeholder="Jelszó">
                </div>
                <button type="submit" name="account-email-change" class="btn btn-primary">Email cím váltás</button>
            </form>
            <hr>
            <form method="POST" class="account-delete-form">
                <h3>Fiók törlése</h3>
                <div class="form-group">
                    <label for="password">Jelszó</label>
                    <input required type="password" name="password" id="passwordDA" maxlength="255" class="form-control" placeholder="Jelszó">
                </div>
                <button type="button" name="account-delete" id="account-delete" class="btn btn-danger">Fiók törlése</button>
            </form>
        </div>
        <!-- deleteConfirmModal -->
        <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <button type="button" id="modal-delete" class="btn btn-danger">Igen (meg nem jo)</button>
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
                            $('html').append(response)
                        },
                        error: function (data) {}
                });
            });
        </script>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
