<?php
if (!isset($_SESSION))
    session_start();

require_once("/var/www/html/model/CommentManager.php");

if (!isset($_POST['pic_id']))
{
    throw new Exception("A problem occured");
    die();
}

$cmtMgmt = new CommentManager();

$req = $cmtMgmt->getComments($_POST['pic_id']);
while ($comment = $req->fetch())
    echo '<p>' . $comment['cmt_content'] . '</p>';