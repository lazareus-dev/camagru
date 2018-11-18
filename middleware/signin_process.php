<?php

require_once($_ROOT."/model/UserManager.php");

$login = "";
$passwd = "";

$userMgmt = new UserManager();

if (isset($_POST['signin']))
{
    if (isset($_POST['login']) && isset($_POST['passwd']))
    {
        $passwd = hash('Whirlpool', $_POST['passwd']);
        $login = htmlspecialchars($_POST['login']);
        $user_info = $userMgmt->getUser($login, $passwd);
        if ($user_info->rowCount() == 0)
        {
            $message='Wrong Login or Password';
            echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
            require($_ROOT."/view/signin.php");
        }
        else
        {
            $_SESSION['usr_id'] = $userMgmt->getUserId($user_info);
            header('Location: /index.php');
        }
    }
}
else
    require($_ROOT."/index.php?action=signup");