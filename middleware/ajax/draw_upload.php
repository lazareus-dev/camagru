<?php

if (!isset($_FILES['up_file']))
{
    echo 'ERROR';
    header("Location: /index.php?action=montage");
    die();
}

$valid_extensions = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
$extension_upload = strtolower(substr(strrchr($_FILES['up_file']['name'], '.'), 1));
if (!in_array($extension_upload, $valid_extensions))
{
    echo 'ERROR=ext';
    die();
}

$data = file_get_contents($_FILES['up_file']['tmp_name']);
$type = basename($_FILES['up_file']['type']);
$data = 'data:image/' . $type . ';base64,' . base64_encode($data);
echo ($data);