<?php
if (!isset($_SESSION))
    session_start();

require_once("/var/www/html/model/PictureManager.php");

if (!isset($_POST['img_data']) || !isset($_POST['sticker_id'])
    || !isset($_SESSION['usr_id']) || $_SESSION['usr_id'] < 1)
{
    throw new Exception("A problem occured");
    die();
}

decodeAndSaveSnapshot($_POST['img_data']);
$img_path = mergeSnapshotAndFilter($_SESSION['usr_id'], $_POST['sticker_id']);
try {
    unlink('./tmp/tmp.jpeg');
} catch (Exception $e) {
    echo "No tmp file";
}

$picMgmt = new PictureManager();
$picMgmt->addPicture($_SESSION['usr_id'], $img_path);


function mergeSnapshotAndFilter($usr_id, $sticker_id)
{
    $filename = uniqid($usr_id.'_');
    $background = imagecreatefromjpeg('./tmp/tmp.jpeg');
    $sticker_path = '/var/www/html/public/images/stickers/';
    $sticker = $sticker_path . "stick_" . $sticker_id . ".png";
    $filter = imagecreatefrompng($sticker);
    imagecopy($background, $filter, 0, 0, 0, 0, imagesx($filter),imagesy($filter));
    $img_path = '/var/www/html/public/pictures/'.$filename.'.png';
    imagepng($background, $img_path);
    $img_path = '/public/pictures/'.$filename.'.png';

    return $img_path;
}

function decodeAndSaveSnapshot($img_data)
{
    $img_data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img_data));
    file_put_contents('./tmp/tmp.jpeg', $img_data);
}


