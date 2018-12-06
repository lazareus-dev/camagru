<?php

if (!isset($_POST['pwd']) || empty($_POST['pwd'])
    || !isset($_POST['resetkey']) || empty($_POST['resetkey']))
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
    echo 'key = ' . $_POST['resetkey'];
    $req = $usrMgmt->getUsrIdFromResetKey($_POST['resetkey']);
    $usr_id = $req->fetch()['usr_id'];
    echo 'usr id = ' . $usr_id;
    $usrMgmt->updatePassword($usr_id, $_POST['pwd']);
    $usrMgmt->deleteResetKey($usr_id);
}