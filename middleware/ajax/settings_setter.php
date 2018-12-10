<?php
if (!isset($_SESSION))
    session_start();
require_once("/var/www/html/model/UserManager.php");

if (!isset($_SESSION['usr_id']) || $_SESSION['usr_id'] < 1)
{
    header('Location: /index.php');
    die();
}

$usrMgmt = new UserManager();

$errors = "";
$ret = 0;
$ret += settingsLogin($usrMgmt);
$ret += settingsEmail($usrMgmt);
$ret += settingsNotif($usrMgmt);
$ret += settingsPasswd($usrMgmt);

if ($errors != "")
    echo $errors;
else if ($ret != 0)
    echo "Changes applied";
else
    echo "No changes to apply";

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
        return (1);
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
        return (1);
    }
}

function settingsNotif($usrMgmt)
{
    if (isset($_POST['notif']))
    {
        if ($_POST['notif'] == 'true')
            $notif = 1;
        else
            $notif = 0;
        $usrMgmt->updateNotif($_SESSION['usr_id'], $notif);
        return (1);
    }
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
        {
            $usrMgmt->updatePassword($_SESSION['usr_id'], $_POST['newpasswd']);
            return (1);
        }
    }
}
