<?php

if (!isset($_FILES['up_file']))
{
    echo 'ERROR';
    header("Location: /index.php?action=montage");
    die();
}

$data = file_get_contents($_FILES['up_file']['tmp_name']);
$type = pathinfo($_FILES['up_file']['tmp_name'], PATHINFO_EXTENSION);
$data = 'data:image/png;base64,' . base64_encode($data);
echo ($data);