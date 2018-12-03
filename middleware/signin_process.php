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
            $user = $user_info->fetch();
            if ($user['usr_activated'] == 1)
            {
                $_SESSION['usr_id'] = $userMgmt->getUserId($user);
                header('Location: /index.php?action=profile');
            }
            else
                header('Location: /index.php?action=signup');
        }
    }
}
else
    require($_ROOT."/index.php?action=signup");