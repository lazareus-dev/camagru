<?php

require_once($_ROOT."/model/PictureManager.php");
require_once($_ROOT."/model/CommentManager.php");

function profilePage()
{
    global $_ROOT;

    if (!isset($_SESSION['usr_id']) || $_SESSION['usr_id'] < 1)
    {
        $login_first = false;
        signinForm($login_first);
        return ;
    }

    require($_ROOT."/view/profile.php");
}

function signinForm($login_first)
{
    global $_ROOT;

    if (isset($_SESSION['usr_id']) && $_SESSION['usr_id'] > 0)
        header('Location: /index.php?action=profile');
    else if (isset($_POST['signin']))
        require($_ROOT."/middleware/signin_process.php");
    else
        require($_ROOT."/view/signin.php");
}

function signupForm()
{
    global $_ROOT;

    if (isset($_SESSION['usr_id']) && $_SESSION['usr_id'] > 0)
        header('Location: /index.php?action=profile');
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
        $login_first = true;
        signinForm($login_first);
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