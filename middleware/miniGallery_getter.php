<?php
if (!isset($_SESSION))
    session_start();

require_once("/var/www/html/model/PictureManager.php");

if (!isset($_SESSION['usr_id']) || $_SESSION['usr_id'] < 1)
{
    throw new Exception("A problem occured");
    die();
}

$picMgmt = new PictureManager();

$req = $picMgmt->getAllUserPics($_SESSION['usr_id']);

while ($result = $req->fetch())
    echo '<img class="mini-gallery-img" src="' .$result['pic_path']. '"><br/>';
