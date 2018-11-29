<?php
if (!isset($_SESSION))
    session_start();

require_once("/var/www/html/model/PictureManager.php");

if (isset($_POST['data']))
{
    $data = $_POST['data'];
    $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
    file_put_contents('./tmp.jpeg', $data);
}

$background = imagecreatefromjpeg('./tmp.jpeg');
$sticker_path = '/var/www/html/public/images/stickers/';
$sticker = $sticker_path . "stick_" . $_POST['sticker_id'] . ".png";
$filter = imagecreatefrompng($sticker);
imagecopy($background, $filter, 0, 0, 0, 0, imagesx($filter),imagesy($filter));
imagepng($background, 'merge.png');




// $picMgmt = new PictureManager();
// if (isset($_SESSION['usr_id']) && isset($_GET['sticker_id']))
//     $picMgmt->addPicture($_SESSION['usr_id'], $_GET['sticker_id']);
