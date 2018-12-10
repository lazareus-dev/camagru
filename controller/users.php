<?php

require_once($_ROOT."/model/UserManager.php");

function signinForm($login_first)
{
    global $_ROOT;

    if (isset($_SESSION['usr_id']) && $_SESSION['usr_id'] > 0)
        header('Location: /index.php?action=profile');
    else if (isset($_POST['signin']))
        require($_ROOT."/middleware/signin_process.php");
    else
        require("../public/view/signin.php");
}

function signupForm()
{
    global $_ROOT;

    if (isset($_SESSION['usr_id']) && $_SESSION['usr_id'] > 0)
        header('Location: /index.php?action=profile');
    else if (isset($_POST['signup']))
        require($_ROOT."/middleware/signup_process.php");
    else
        require("../public/view/signup.php");
}

function confirmAccount($activkey)
{
    $usrMgmt = new UserManager();
    $ret = $usrMgmt->activateUser($activkey);
    if ($ret == -1)
        header('Location: /index.php');
    else if ($ret == 0)
        header('Location: /index.php?action=activconfirm?status=already');
    else
        header('Location: /index.php');
}

function resetPassword()
{
    if (isset($_GET['resetkey']) && $_GET['resetkey'] != 0)
    {
        $usrMgmt = new UserManager();
        $req = $usrMgmt->getUsrIdFromResetKey($_GET['resetkey']);
        if ($req->rowCount() != 0)
            require("../public/view/reset_passwd.php");
        else
            header('Location: /index.php');
    }
    else
        require("../public/view/reset_passwd_mail.php");
}