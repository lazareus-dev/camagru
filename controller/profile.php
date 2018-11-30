<?php

function profilePage()
{
    global $_ROOT;

    if (!isset($_SESSION['usr_id']) || $_SESSION['usr_id'] < 1)
    {
        $login_first = false;
        signinForm($login_first);
        return ;
    }
    require($_ROOT."/middleware/profile_getter.php");
    require($_ROOT."/view/profile.php");
}