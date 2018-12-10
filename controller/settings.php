<?php

function settingsPage()
{
    global $_ROOT;

    if (!isset($_SESSION['usr_id']) || $_SESSION['usr_id'] < 1)
    {
        $login_first = true;
        signinForm($login_first);
        die();
    }
    else
    {
        require($_ROOT."/middleware/settings_getter.php");
        require("../public/view/settings.php");
    }
}