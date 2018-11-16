<?php

require_once($_ROOT."/model/PictureManager.php");
require_once($_ROOT."/model/CommentManager.php");

function settingsPage()
{
    global $_ROOT;

    if (!isset($_SESSION['usr_id']) || $_SESSION['usr_id'] < 1)
    {
        $login_first = 1;
        require($_ROOT."/view/signin.php");
        return ;
    }

    require($_ROOT."/view/settings.php");
}

function profilePage()
{
    global $_ROOT;

    if (!isset($_SESSION['usr_id']) || $_SESSION['usr_id'] < 1)
    {
        $login_first = 1;
        require($_ROOT."/view/signin.php");
        return ;
    }

    require($_ROOT."/view/profile.php");
}

function signinForm()
{
    global $_ROOT;

    require($_ROOT."/view/signin.php");
}

function signupForm()
{
    global $_ROOT;

    if (isset($_POST['signup']))
        require($_ROOT."/middleware/signup_process.php");
    else
        require($_ROOT."/view/signup.php");
}

function montagePage()
{
    global $_ROOT;

    if (!isset($_SESSION['usr_id']) || $_SESSION['usr_id'] < 1)
    {
        $login_first = 1;
        require($_ROOT."/view/signin.php");
        return ;
    }

    require($_ROOT."/view/montage.php");
}

function displayPictures()
{
    global $_ROOT;

    $picManager = new PictureManager();
    $pictures = $picManager->getPictures();

    require($_ROOT."/view/main_gallery.php");
}

function addComment($usr_id, $pic_id, $comment)
{
    $cmtManager = new CommentManager();
    $affectedLines = $cmtManager->postComment($usr_id, $pic_id, $comment);

    if ($affectedLines === false)
        throw new Exception('Error while adding comment');
}