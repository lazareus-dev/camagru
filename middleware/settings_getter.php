<?php

require_once($_ROOT."/model/UserManager.php");

if (!isset($_SESSION['usr_id']) || $_SESSION['usr_id'] < 1)
    die();

$login = "Lazareus";
$email = "lazy@laz.fr";
$notif = true;
$userMgmt = new UserManager();

$req = $userMgmt->getUserSettings($_SESSION['usr_id']);

$user_datas = $req->fetch();
$login = $user_datas['usr_login'];
$email = $user_datas['usr_mail'];
$notif = $user_datas['usr_notif'];
