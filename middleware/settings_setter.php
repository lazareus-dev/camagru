<?php

require_once($_ROOT."/model/UserManager.php");

if (!isset($_SESSION['usr_id']) || !isset($_SESSION['login'])
    ||!isset($_SESSION['email']) || !isset($_SESSION['notif']))
{
    throw new Exception("A problem occured");
    die();
}

$usrMgmt = new UserManager();

if (isset($_POST['login']) && ($_POST['login'] !== $_SESSION['login']))
    $usrMgmt->updateLogin($_SESSION['usr_id'], $_POST['login']);
if (isset($_POST['email']) && ($_POST['email'] !== $_SESSION['email']))
    $usrMgmt->updateEmail($_SESSION['usr_id'], $_POST['email']);
if (isset($_POST['notif']))
    $new_notif = true;
if ($new_notif != $_SESSION['notif'])
    $usrMgmt->updateNotif($_SESSION['usr_id'], $new_notif);
if (isset($_POST['newpasswd']))
{
    if (!isset($_POST['oldpasswd'])){
        $_SESSION['error'] = 'need_old_passwd';
        header('Location: /index.php?action=settings');
    }
}

header('Location: /index.php?action=settings');
