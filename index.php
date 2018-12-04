<?php
if (!isset($_SESSION))
    session_start();
$_ROOT = getcwd();
require_once($_ROOT."/controller/users.php");
require_once($_ROOT."/controller/controller.php");
require_once($_ROOT."/controller/settings.php");
require_once($_ROOT."/controller/profile.php");
require_once($_ROOT."/controller/display_single_picture.php");

try {

if (isset($_GET['action']))
{
    if ($_GET['action'] == 'signup')
        signupForm();
    else if ($_GET['action'] == 'signin')
        signinForm(0);
    else if ($_GET['action'] == 'montage')
        montagePage();
    else if ($_GET['action'] == 'profile')
        profilePage();
    else if ($_GET['action'] == 'settings')
        settingsPage();
    else if ($_GET['action'] == 'display' && isset($_GET['pic_id']))
        displaySinglePicture();
    else if ($_GET['action'] == 'logout')
    {
        session_destroy();
        header('Location: /index.php');
    }
    else if ($_GET['action'] == 'confirm' && isset($_GET['activkey']))
        confirmAccount($_GET['activkey']);
    else if ($_GET['action'] == 'resetpwd')
        resetPassword();
    else if ($_GET['action'] == 'notfound')
        pageNotFound();
    else
        displayAllPictures();
}
else
    displayAllPictures();

} catch (Exception $e) {
    echo 'Error : ' . $e->getMessage();
}