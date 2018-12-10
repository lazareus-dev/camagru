<?php
if (!isset($_SESSION))
    session_start();

require_once("/var/www/html/model/CommentManager.php");

if (!isset($_POST['pic_id']))
{
    header('Location: /index.php');
    die();
}

$cmtMgmt = new CommentManager();

$req = $cmtMgmt->getComments($_POST['pic_id']);
while ($comment = $req->fetch())
{
    echo '<div class="comment-container" id="'. $comment['cmt_id'] .'"
          ondblclick="deleteComment('. $comment['cmt_id'] .')">';
    echo '<div class="comment">' . $comment['cmt_content'] . '</div>';
    echo '<div class="cmt-usr">by ' . $comment['usr_login'] . '</div>';
    echo '</div>';
}