<?php

require_once($_ROOT."/model/PictureManager.php");

function profilePage()
{
    global $_ROOT;

    if (!isset($_SESSION['usr_id']) || $_SESSION['usr_id'] < 1)
    {
        $login_first = false;
        signinForm($login_first);
        return ;
    }

    $picMgmt = new PictureManager();

    if (isset($_GET['profile_id']))
        $picReq = $picMgmt->getAllUserPics($_GET['profile_id']);
    else
        $picReq = $picMgmt->getAllUserPics($_SESSION['usr_id']);
    require($_ROOT."/view/profile.php");
}
