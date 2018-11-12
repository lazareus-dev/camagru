<?php
$_ROOT = getcwd();

require($_ROOT."/controller/controller.php");

if (isset($_GET['action']))
{
    if ($_GET['action'] == 'signup')
        require($_ROOT."/view/signup.php");
    else if ($_GET['action'] == 'signin')
        require($_ROOT."/view/connection.php");
}
else
    displayPictures();