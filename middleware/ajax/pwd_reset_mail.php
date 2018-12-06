<?php

if (!isset($_POST['mail']) || empty($_POST['mail']))
{
    echo 'Error';
    die();
}

require_once("/var/www/html/model/UserManager.php");
require_once("/var/www/html/controller/mail.php");

$usrMgmt = new UserManager();

$resetkey = hash('Whirlpool', uniqid());

$usrMgmt->insertResetKey($_POST['mail'], $resetkey);

sendResetMail($_POST['mail'], $resetkey);
echo "Mail sent";