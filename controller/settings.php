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
    if (isset($_POST['apply']) && $_POST['apply'] == 'apply')
        require($_ROOT."/middleware/settings_setter.php");
    else
    {
        require($_ROOT."/middleware/settings_getter.php");
        require($_ROOT."/view/settings.php");
    }
}