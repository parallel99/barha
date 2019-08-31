<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/include/mail-send.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/include/mailconfirm.php');
$Mail = new Mail();
$Mail->name = "123";
$Mail->emailaddress = "hajaserik090@gmail.com";
$Mail->title = "123";
$Mail->message = confirm("erik", "token");
$Mail->Send();
echo "succes";
