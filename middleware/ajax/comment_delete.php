<?php
if (!isset($_SESSION))
    session_start();

require_once("/var/www/html/model/CommentManager.php");

if (!isset($_POST['cmt_id']))
{
    header('Location: /index.php');
    die();
}

$cmtMgmt = new CommentManager();

$req = $cmtMgmt->getCommentById($_POST['cmt_id']);

if ($req->fetch()['usr_id'] == $_SESSION['usr_id'])
    $cmtMgmt->deleteComment($_POST['cmt_id']);