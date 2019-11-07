<form method="post">
  <input type="text" name="n">
  <input type="submit" name="s">
</form>
<?php
if(isset($_POST["s"])){
    require 'vendor/autoload.php';
    $authenticator = new PHPGangsta_GoogleAuthenticator();
    $secret = $authenticator->createSecret();
    echo "Secret: ".$secret;


    //$secret = 'PQ3HQXIADIERWMAH';
    $otp = $_POST["n"] ;//Generated by Authenticator.

    $tolerance = 5;

    $checkResult = $authenticator->verifyCode($secret, $otp, $tolerance);

    if ($checkResult)
    {
        echo '<br>OTP is Validated Succesfully';

    } else {
        echo '<br>FAILED<br><br>';
    }

    $cht = "qr";
    // CHart Size
    $chs = "200x200";

    // default: UTF-8
    $choe = "UTF-8";

    $qrcode = 'https://chart.googleapis.com/chart?cht=' . $cht . '&chs=' . $chs . '&chl=otpauth://totp/BarHa?secret=' . $secret . '&choe=' . $choe;
    echo "<img src=". $qrcode ." alt='Secret key'>";
}
?>
