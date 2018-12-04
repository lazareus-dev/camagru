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
        require($_ROOT."/view/signin.php");
}

function signupForm()
{
    global $_ROOT;

    if (isset($_SESSION['usr_id']) && $_SESSION['usr_id'] > 0)
        header('Location: /index.php?action=profile');
    else if (isset($_POST['signup']))
        require($_ROOT."/middleware/signup_process.php");
    else
        require($_ROOT."/view/signup.php");
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
    {
        header('Location: /index.php?action=activconfirm?status=ok');
        $_SESSION['usr_id'] = $ret;
    }
}

function resetPassword()
{
    global $_ROOT;

    require($_ROOT."/view/reset_passwd.php");
}