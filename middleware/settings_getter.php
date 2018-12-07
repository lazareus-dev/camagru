<?php


if (!isset($_SESSION['usr_id']) || $_SESSION['usr_id'] < 1)
{
    header('Location: /index.php');
    die();
}

require_once($_ROOT."/model/UserManager.php");

$userMgmt = new UserManager();

$req = $userMgmt->getUserSettings($_SESSION['usr_id']);

$user_datas = $req->fetch();
$_SESSION['login'] = $user_datas['usr_login'];
$_SESSION['email'] = $user_datas['usr_mail'];
$_SESSION['notif'] = $user_datas['usr_notif'];
