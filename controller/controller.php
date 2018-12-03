<?php

require_once($_ROOT."/model/UserManager.php");
require_once($_ROOT."/model/PictureManager.php");

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