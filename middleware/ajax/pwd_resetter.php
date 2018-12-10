<?php

if (!isset($_POST['pwd']) || empty($_POST['pwd'])
    || !isset($_POST['resetkey']) || empty($_POST['resetkey']))
{
    header('Location: /index.php');
    die();
}

require_once("/var/www/html/model/UserManager.php");

$usrMgmt = new UserManager();

$ret = $usrMgmt->checkPwdStrength($_POST['pwd']);
if ($ret != "")
    echo $ret;
else
{
    $req = $usrMgmt->getUsrIdFromResetKey($_POST['resetkey']);
    $usr_id = $req->fetch()['usr_id'];
    $usrMgmt->updatePassword($usr_id, $_POST['pwd']);
    $usrMgmt->deleteResetKey($usr_id);
    echo 'Please try to login with your new password';
}