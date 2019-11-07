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
    echo "Secret: ".$secret;

    //$secret = 'PQ3HQXIADIERWMAH';
    $otp = $_POST["text"] ;

    $tolerance = 2;//2*30sec

    $checkResult = $authenticator->verifyCode($secret, $otp, $tolerance);

    if ($checkResult) {
        echo '<br>OTP is Validated Succesfully';
    } else {
        echo '<br>FAILED<br><br>';
    }

    $cht = "qr";
    $chs = "300x300";
    $choe = "UTF-8";

    $qrcode = 'https://chart.googleapis.com/chart?cht=' . $cht . '&chs=' . $chs . '&chl=otpauth://totp/BarHa?secret=' . $secret . '&choe=' . $choe;

    echo "<img src=". $qrcode ." alt='Secret key'>";
?>
