<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/include/mail-send.php');
$Mail = new Mail("Erik", "hajaserik090@gmail.com", "<strong>Béna vagy!</strong>");
$Mail->Send();
echo "succes";
