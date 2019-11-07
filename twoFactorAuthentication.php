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
    $chs = "300x300";

    // default: UTF-8
    $choe = "UTF-8";
    $qrcode = 'https://www.google.com/chart?chs=200x200&chld=M|0&cht=qr&chl=otpauth://totp/BárHa?secret=' . $secret.'&choe=utf-8';
    echo "<img src=". $qrcode ." alt='Secret key'>";
}
?>
