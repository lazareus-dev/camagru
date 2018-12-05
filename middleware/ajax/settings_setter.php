<?php
if (!isset($_SESSION))
    session_start();
require_once("/var/www/html/model/UserManager.php");

if (!isset($_SESSION['usr_id']))
{
    throw new Exception("A problem occured");
    die();
}

$usrMgmt = new UserManager();

$errors = "";

settingsLogin($usrMgmt);
settingsEmail($usrMgmt);
// settingsNotif($usrMgmt);
settingsPasswd($usrMgmt);
if ($errors != "")
    echo $errors;
else
    echo "Changes applied";

function settingsLogin($usrMgmt)
{
    global $errors;

    if (isset($_POST['login']) && ($_POST['login'] !== $_SESSION['login']))
    {
        $new_login = htmlspecialchars($_POST['login']);
        if (!$usrMgmt->checkIfLoginExists($new_login))
            $usrMgmt->updateLogin($_SESSION['usr_id'], $new_login);
        else
        {
            $errors .= 'Unvailable login
';
        }
    }
}

function settingsEmail($usrMgmt)
    {
    global $errors;

    if (isset($_POST['email']) && $_POST['email'] != "" && ($_POST['email'] !== $_SESSION['email']))
    {
        if (!$usrMgmt->checkIfMailExists($_POST['email']))
            $usrMgmt->updateEmail($_SESSION['usr_id'], $_POST['email']);
        else
        {
            $errors .= 'Unvailable email
';
        }
    }
}

function settingsNotif($usrMgmt)
{
    if (isset($_POST['notif']))
        $new_notif = true;
    if ($new_notif != $_SESSION['notif'])
        $usrMgmt->updateNotif($_SESSION['usr_id'], $new_notif);
}

function settingsPasswd($usrMgmt)
{
    global $errors;

    if (isset($_POST['newpasswd']) && $_POST['newpasswd'] != "")
    {
        $newpwd = $_POST['newpasswd'];
        if ($usrMgmt->checkPwdStrength($newpwd) != "")
        {
            $errors .= 'Password must contain at least : 1 uppercase, 1 lowercase, 1 number, 1 special character
            ';
        }
        else if (!isset($_POST['oldpasswd']))
        {
            $errors .= 'Old Password must be filled';
        }
        else if ($usrMgmt->checkPassword($_SESSION['usr_id'], $_POST['oldpasswd']))
            $usrMgmt->updatePassword($_SESSION['usr_id'], $_POST['newpasswd']);
    }
}
