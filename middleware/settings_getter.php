<?php

require_once($_ROOT."/model/UserManager.php");

if (!isset($_SESSION['usr_id']) || $_SESSION['usr_id'] < 1)
    die();

$userMgmt = new UserManager();

$req = $userMgmt->getUserSettings($_SESSION['usr_id']);

$user_datas = $req->fetch();
$_SESSION['login'] = $user_datas['usr_login'];
$_SESSION['email'] = $user_datas['usr_mail'];
$_SESSION['notif'] = $user_datas['usr_notif'];
