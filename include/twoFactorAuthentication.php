<!--
<form method="post">
    <input type="text" name="text">
    <input type="submit" name="submit">
</form>
-->
<?php
    require '../vendor/autoload.php';
    $authenticator = new PHPGangsta_GoogleAuthenticator();
    $secret = $authenticator->createSecret();

    //$secret = 'PQ3HQXIADIERWMAH';
/*    $otp = $_POST["text"] ;

    $tolerance = 2;//2*30sec

    $checkResult = $authenticator->verifyCode($secret, $otp, $tolerance);

    if ($checkResult) {
        echo '<br>OTP is Validated Succesfully';
    } else {
        echo '<br>FAILED<br><br>';
    }*/

    $cht = "qr";
    $chs = "300x300";
    $choe = "UTF-8";

    $qrcode = 'https://chart.googleapis.com/chart?cht=' . $cht . '&chs=' . $chs . '&chl=otpauth://totp/BarHa?secret=' . $secret . '&choe=' . $choe;

    ?>
        <script>$('auth-modal').modal('toggle')</script>
        <div id="auth-modal" class="modal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Google Authenticator</h5>
              </div>
              <div class="modal-body">
                  <?php
                      echo "<img class=\"auth-qr-code\" src=". $qrcode ." alt='Secret key'>";
                      echo "<p class=\"auth-secret\">" . $secret . "</p>";
                  ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary">Kész</button>
              </div>
            </div>
          </div>
       </div>
