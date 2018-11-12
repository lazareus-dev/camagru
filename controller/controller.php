<?php

require_once($_ROOT."/model/PicturesManager.php");
require_once($_ROOT."/model/CommentsManager.php");

function displayPictures()
{
    global $_ROOT;

    $picManager = new PicturesManager();
    $pictures = $picManager->getPictures();

    require($_ROOT."/view/main_gallery.php");
}

function addComment($usr_id, $pic_id, $comment)
{
    $cmtManager = new CommentsManager();
    $affectedLines = $cmtManager->postComment($usr_id, $pic_id, $comment);

    if ($affectedLines === false)
        throw new Exception('Error while adding comment');
}