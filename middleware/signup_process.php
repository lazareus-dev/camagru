<?php

if (!isset($_ROOT) || !isset($_POST['signup'])
|| !isset($_POST['login']) || !isset($_POST['passwd'])
|| !isset($_POST['email']))
{
    header('Location: /index.php');
    die();
}

require_once($_ROOT."/model/UserManager.php");

$login = "";
$email = "";
$passwd = "";
$regex = '$S*(?=S{8,})(?=S*[a-z])(?=S*[A-Z])(?=S*[d])(?=S*[W])S*$';

$usrMgmt = new UserManager();

if (isset($_POST['signup']))
{
    if (isset($_POST['login']) && $_POST['login'] != ""
        && isset($_POST['email'])&& $_POST['login'] != ""
        && isset($_POST['passwd']) && $_POST['login'] != "")
    {
        $login = htmlspecialchars($_POST['login']);
        $email = $_POST['email'];
        if ($usrMgmt->checkIfUserExists($login, $email))
        {
            $message='Login or Email already exists';
            echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
            require("../public/view/signup.php");
        }
        else if ($usrMgmt->checkPwdStrength($_POST['passwd']) != "")
        {
            $message='Password must contain at least : 1 uppercase, 1 lowercase, 1 number, 1 special character';
            echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
            require("../public/view/signup.php");
        }
        else
        {
            $passwd = hash('Whirlpool', $_POST['passwd']);
            $activkey = hash('Whirlpool', uniqid());
            $pp = rand(1, 8);
            $usrMgmt->createUser($login, $email, $pp, $passwd, $activkey);
            $new_user = true;
            require($_ROOT.'/controller/mail.php');
            header('Location: /index.php');
        }
    }
}
else
    header("Location: /signup");