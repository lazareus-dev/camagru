<?php

require_once($_ROOT."/model/UserManager.php");

if (!isset($_SESSION['usr_id']) || !isset($_SESSION['login'])
    ||!isset($_SESSION['email']) || !isset($_SESSION['notif']))
{
    throw new Exception("A problem occured");
    die();
}

$usrMgmt = new UserManager();

settingsLogin($usrMgmt);
settingsEmail($usrMgmt);
settingsNotif($usrMgmt);
settingsPasswd($usrMgmt);
header('Location: /index.php?action=settings');

function settingsLogin($usrMgmt)
{
    if (isset($_POST['login']) && ($_POST['login'] !== $_SESSION['login']))
    {
        $new_login = htmlspecialchars($_POST['login']);
        if (!$usrMgmt->checkIfLoginExists($new_login))
            $usrMgmt->updateLogin($_SESSION['usr_id'], $new_login);
        else {
            $_SESSION['error'] = 'unavailable_login';
            header('Location: /index.php?action=settings');
        }
    }
}

function settingsEmail($usrMgmt)
{
    if (isset($_POST['email']) && $_POST['email'] != "" && ($_POST['email'] !== $_SESSION['email']))
    {
        if (!$usrMgmt->checkIfMailExists($_POST['email']))
            $usrMgmt->updateEmail($_SESSION['usr_id'], $_POST['email']);
        else {
            $_SESSION['error'] = 'unavailable_email';
            header('Location: /index.php?action=settings');
        }
    }
}

function settingsNotif($usrMgmt)
{
    if (isset($_POST['notif']))
        $new_notif = true;
    if ($new_notif != $_SESSION['notif'])
        $usrMgmt->updateNotif($_SESSION['usr_id'], $new_notif);
}

function settingsPasswd($usrMgmt)
{
    if (isset($_POST['newpasswd']))
    {
        if (!isset($_POST['oldpasswd'])){
            $_SESSION['error'] = 'need_old_passwd';
            header('Location: /index.php?action=settings');
            die();
        }
        if ($usrMgmt->checkPassword($_SESSION['usr_id'], $_POST['oldpasswd']))
            $usrMgmt->updatePassword($_SESSION['usr_id'], $_POST['newpasswd']);
    }
}
