<?php

if (!isset($_GET['pic_id']))
    die();

require_once("/var/www/html/model/PictureManager.php");
require_once($_ROOT."/model/UserManager.php");

$picMgmt = new PictureManager();
$usrMgmt = new UserManager();

$req = $picMgmt->getPictureInfos($_GET['pic_id']);

if ($req->rowCount() == 0)
{
    header("Location: /index.php?action=notfound");
    die();
}

$pic = $req->fetch();
$owner_id = $usrMgmt->getLoginFromId($pic['usr_id']);
$nb_likes = $picMgmt->getNumberOfLikes($pic['pic_id'])[0];
$nb_comments = $picMgmt->getNumberOfComments($pic['pic_id']);