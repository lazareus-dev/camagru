<?php
if (!isset($_SESSION))
    session_start();

require_once("/var/www/html/model/CommentManager.php");
require_once("/var/www/html/controller/mail.php");

if (!isset($_POST['pic_id']) || !isset($_POST['comment'])
    || !isset($_SESSION['usr_id']) || $_SESSION['usr_id'] < 1)
{
    header('Location: /index.php');
    die();
}

addComment($_SESSION['usr_id'], $_POST['pic_id'], $_POST['comment']);

function addComment($usr_id, $pic_id, $comment)
{
    $comment = htmlspecialchars($comment);
    $cmtManager = new CommentManager();
    $affectedLines = $cmtManager->postComment($usr_id, $pic_id, $comment);

    if ($affectedLines === false)
        throw new Exception('Error while adding comment');
    else
    {
        $type = 'comment';
        sendNotificationMail($type, $pic_id, $comment);
    }
}