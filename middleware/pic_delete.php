<?php
if (!isset($_SESSION))
    session_start();

if (!isset($_POST['pic_id']) || !isset($_SESSION['usr_id']))
{
    header('Location: /index.php');
    die();
}

require_once("/var/www/html/model/PictureManager.php");

$picMgmt = new PictureManager();
$ret = $picMgmt->requestDeletePicture($_POST['pic_id'], $_SESSION['usr_id']);
