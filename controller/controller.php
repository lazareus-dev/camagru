<?php

require_once($_ROOT."/model/UserManager.php");
require_once($_ROOT."/model/PictureManager.php");
require_once($_ROOT."/model/CommentManager.php");

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

function displayAllPictures()
{
    global $_ROOT;

    $usrMgmt = new UserManager();
    $picMgmt = new PictureManager();

    $pictures = $picMgmt->getAllPictures();

    require($_ROOT."/view/main_gallery.php");
}

function pageNotFound()
{
    global $_ROOT;

    require($_ROOT."/view/page_not_found.php");
}