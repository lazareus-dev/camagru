<?php
if (!isset($_SESSION))
{
    session_start();
    $_SESSION['usr_id'] = -1;
}
$_ROOT = getcwd();
require_once($_ROOT."/controller/controller.php");

try {

if (isset($_GET['action']))
{
    if ($_GET['action'] == 'signup')
        signupForm();
    else if ($_GET['action'] == 'signin')
        signinForm();
    else if ($_GET['action'] == 'montage')
        montagePage();
    else if ($_GET['action'] == 'profile')
        profilePage();
    else if ($_GET['action'] == 'settings')
        settingsPage();
    else if ($_GET['action'] == 'logout')
    {
        session_destroy();
        displayPictures();
    }
    else if ($_GET['action'] == 'addComment')
    {
        if (isset($_SESSION['usr_id']) && $_SESSION['usr_id'] > 0)
            if (!empty($_POST['comment']))
                addComment($_SESSION['usr_id'], $_POST['pic_id'], $_POST['comment']);
    }
}
else
    displayPictures();

} catch (Exception $e) {
    echo 'Error : ' . $e->getMessage();
}