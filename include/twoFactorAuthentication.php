<?php
require '../vendor/autoload.php';
$authenticator = new PHPGangsta_GoogleAuthenticator();
try {
    $secret = $authenticator->createSecret();
} catch (Exception $e) {
}

$_SESSION['secret'] = $secret;

$cht = "qr";
$chs = "300x300";
$choe = "UTF-8";

$qrcode = 'https://chart.googleapis.com/chart?cht=' . $cht . '&chs=' . $chs . '&chl=otpauth://totp/BarHa?secret=' . $secret . '&choe=' . $choe;

$_SESSION['qrcode'] = $qrcode;
$_SESSION['secret'] = $secret;

echo '$(".auth-qr-code").attr("src", "' . $qrcode . '");';
echo '$("#secret").text("' . $secret . '"");';