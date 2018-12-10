<?php

function displaySinglePicture()
{
    global $_ROOT;
    
    if (!isset($_SESSION['usr_id']) || $_SESSION['usr_id'] < 1)
    {
        $login_first = true;
        signinForm($login_first);
        die();
    }
    require("../middleware/pic_info_getter.php");
    require("../public/view/display_single_picture.php");
}