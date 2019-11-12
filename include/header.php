<meta name="author" content="Hajas Erik, Baranyai Máté"/>
<meta name="description" content="">
<meta name="keywords" content="">

<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge"/>

<link href="https://fonts.googleapis.com/css?family=Kalam:400,700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="/css/main.css"/>

<base href="https://barha.herokuapp.com"/>

<!-- Favicon -->
<link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
<link rel="manifest" href="/images/site.webmanifest">
<link rel="mask-icon" href="/images/safari-pinned-tab.svg" color="#828282">
<link rel="shortcut icon" href="/images/favicon.ico">
<meta name="msapplication-TileColor" content="#f8f8f8">
<meta name="msapplication-config" content="/images/browserconfig.xml">
<meta name="theme-color" content="#f8f9fa">

<!-- Open Graph -->
<meta property="og:title" content="BárHa"/>
<meta property="og:description" content=""/>
<meta property="og:image" content="/images/og.png"/>
<meta property="og:image:width" content="1200"/>
<meta property="og:image:height" content="630"/>
<meta property="og:type" content="website"/>

<meta name="referrer" content="origin">

<!-- PWA -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">

<link rel="apple-touch-startup-image" href="/images/apple-touch-icon.png">

<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="apple-mobile-web-app-title" content="BárHa">

<?php
date_default_timezone_set("Europe/Budapest");
ob_start();

if (isset($_COOKIE["userid"]) && !isset($_SESSION['user'])) {
    include($_SERVER['DOCUMENT_ROOT'] . '/include/db.php');
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindValue(':id', $_COOKIE["userid"], PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $_SESSION['user'] = array("name" => $row->name, "email" => $row->email, "permission" => $row->permission);
}

if(isset($_SESSION['user']['lang'])){
    include($_SERVER['DOCUMENT_ROOT'] . "/lang/" . $_SESSION['user']['lang'] . ".php");
}else{
    include($_SERVER['DOCUMENT_ROOT'] . "/lang/hu.php");
}
?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-151926533-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-151926533-1');
</script>


<script src="/js/jquery-3.4.1.min.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
