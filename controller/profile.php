<?php

require_once($_ROOT."/model/PictureManager.php");
require_once($_ROOT."/model/UserManager.php");

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
    $usrMgmt = new UserManager();

    $picReq = $picMgmt->getAllUserPics($_SESSION['usr_id']);
    $pp = $usrMgmt->getPpFromId($_SESSION['usr_id']);
    require("../public/view/profile.php");
}
