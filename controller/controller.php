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

    require("../public/view/montage.php");
}

function displayAllPictures($page)
{
    global $_ROOT;

    $usrMgmt = new UserManager();
    $picMgmt = new PictureManager();

    require($_ROOT."/middleware/paginate_pic.php");
    require("../public/view/main_gallery/main_gallery.php");
}

function pageNotFound()
{
    require("../public/view/page_not_found.php");
}