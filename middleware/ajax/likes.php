<?php
if (!isset($_SESSION))
    session_start();

if (!isset($_POST['pic_id']) || empty($_POST['pic_id'])
    || !isset($_SESSION['usr_id']) || $_SESSION['usr_id'] < 1)
{
    echo 'Error';
    die();
}

require_once("/var/www/html/model/PictureManager.php");

$picMgmt = new PictureManager();

if (isset($_POST['is_liked']) && $_POST['is_liked'] == 1
    && $picMgmt->isLikedByUser($_POST['pic_id'], $_SESSION['usr_id']))
    $picMgmt->dislikePicture($_POST['pic_id'], $_SESSION['usr_id']);
else
{
        $picMgmt->likePicture($_POST['pic_id'], $_SESSION['usr_id']);
}
echo $picMgmt->getNumberOfLikes($_POST['pic_id'])[0];