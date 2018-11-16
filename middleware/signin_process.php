<?php

require_once($_ROOT."/model/UserManager.php");

$login = "";
$passwd = "";

$user = new UserManager();

if (isset($_POST['signin']))
{
    if (isset($_POST['login']) && isset($_POST['passwd']))
    {
        $login = htmlspecialchars($_POST['login']);
        if ($user->checkIfLoginExists($login))
        {
            $message='Login does not exists';
            echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
            require($_ROOT."/view/signin.php");
        }
        else
        {
            $passwd = password_hash($_POST['passwd'], PASSWORD_DEFAULT);
            $user->createUser($login, $email, $passwd);
            header('Location: /index.php');
        }
    }
}
else
    require($_ROOT."/index.php?action=signup");