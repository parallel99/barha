<?php
    require '../vendor/autoload.php';
    $authenticator = new PHPGangsta_GoogleAuthenticator();
    $secret = $authenticator->createSecret();

    $_SESSION['secret'] = $secret;

    $cht = "qr";
    $chs = "300x300";
    $choe = "UTF-8";

    $qrcode = 'https://chart.googleapis.com/chart?cht=' . $cht . '&chs=' . $chs . '&chl=otpauth://totp/BarHa?secret=' . $secret . '&choe=' . $choe;

    ?>
<div id="auth-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Google Authenticator</h5>
      </div>
      <div class="modal-body">
          Olvasd be a QR kódot a Google Authenticator alkalmazassal
          <?php
              echo "<img class=\"auth-qr-code\" src=". $qrcode ." alt='Secret key'>";
              echo "<p class=\"auth-secret small text-muted\">" . $secret . "</p>";
          ?>
          <h4 class="download-google-authenticator-text">Még nincs letöltve?</h4>
          <h4 class="download-google-authenticator-text">Itt megteheted</h4>
          <div class="row">
            <div class="col-6">
              <a href='https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img alt='Szerezd meg: Google Play' src='https://play.google.com/intl/en_us/badges/static/images/badges/hu_badge_web_generic.png'/></a>
            </div>
            <div class="col-6">
              <a href='https://apps.apple.com/us/app/google-authenticator/id388497605'><img alt='Szerezd meg: App Store' src='images/download-with-app-store.svg'/></a>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Mégsem</button>
        <button type="button" class="btn btn-primary" name="saveSecretKey" id="saveSecretKey" data-dismiss="modal">Kész</button>
      </div>
    </div>
  </div>
</div>
<script>
    $('#auth-modal').modal('toggle');
    $("body").css("padding-right", "0");

    $("#saveSecretKey").click(function() {
        $("#enable-2-step-auth").remove();
        $.ajax({
        url: 'include/saveSecretKey.php',
                type: 'post',
                data: {},
                success: function (response) {},
                error: function (data) {}
        });
        $('.account-2-step-auth-form').append("<input type=\"button\" class=\"btn btn-primary\" id=\"disable-2-step-auth\" value=\"Engedélyezve🎉\">");
    });
</script>
