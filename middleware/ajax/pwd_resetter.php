<?php

if (!isset($_POST['pwd']) || empty($_POST['pwd']))
{
    echo 'Error';
    die();
}

require_once("/var/www/html/model/UserManager.php");

$usrMgmt = new UserManager();

$ret = $usrMgmt->checkPwdStrength($_POST['pwd']);

if ($ret != "")
    echo $ret;
else
{

}