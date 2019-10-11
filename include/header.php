<meta name="author" content="Hajas Erik, Baranyai Máté"/>
<meta name="description" content="">
<meta name="keywords" content="">

<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge"/>

<link href="https://fonts.googleapis.com/css?family=Kalam:400,700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="/css/main.css"/>

<!-- Favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
<link rel="manifest" href="/images/site.webmanifest">
<link rel="mask-icon" href="/images/safari-pinned-tab.svg" color="#828282">
<link rel="shortcut icon" href="/images/favicon.ico">
<meta name="msapplication-TileColor" content="#f8f8f8">
<meta name="msapplication-config" content="/images/browserconfig.xml">
<meta name="theme-color" content="#ffffff">

<!-- Open Graph -->
<meta property="og:title" content="BárHa"/>
<meta property="og:description" content=""/>
<meta property="og:image" content="/images/og.png"/>
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
<meta property="og:type" content="website"/>

<meta name="referrer" content="origin">

<?php
date_default_timezone_set("Europe/Budapest");
ob_start();
/*if (isset($_POST["cookie-OK"])) {
    setcookie("cookieok", 1, time() + (2592000 * 12), "/");
}*/

if (isset($_COOKIE['email'])) {
    $_SESSION['user']['email'] = $_COOKIE['email'];
}
if (isset($_COOKIE['name'])) {
    $_SESSION['user']['name'] = $_COOKIE['name'];
}
?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
