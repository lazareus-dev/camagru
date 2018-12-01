<?php
if (!isset($_SESSION))
    session_start();

require_once("/var/www/html/model/CommentManager.php");

if (!isset($_POST['pic_id']) || !isset($_POST['comment'])
    || !isset($_SESSION['usr_id']) || $_SESSION['usr_id'] < 1)
{
    throw new Exception("A problem occured");
    die();
}

addComment($_SESSION['usr_id'], $_POST['pic_id'], $_POST['comment']);

function addComment($usr_id, $pic_id, $comment)
{
    $cmtManager = new CommentManager();
    $affectedLines = $cmtManager->postComment($usr_id, $pic_id, $comment);

    if ($affectedLines === false)
        throw new Exception('Error while adding comment');
}