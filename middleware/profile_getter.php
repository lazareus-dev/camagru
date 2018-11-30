<?php
if (!isset($_SESSION))
    session_start();

require_once("/var/www/html/model/PictureManager.php");

$picMgmt = new PictureManager();

$picReq = $picMgmt->getAllUserPics($_SESSION['usr_id']);

if (!isset($_SESSION['login']))
    require("/var/www/html/middleware/settings_getter.php");