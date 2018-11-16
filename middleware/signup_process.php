<?php

require_once($_ROOT."/model/UserManager.php");

$login = "";
$email = "";
$passwd = "";

$user = new UserManager();

if (isset($_POST['signup']))
{
    if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['passwd']))
    {
        $login = htmlspecialchars($_POST['login']);
        $email = $_POST['email'];
        if ($user->checkIfUserExists($login, $email))
        {
            $message='Login or Email already exists';
            echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
            require($_ROOT."/view/signup.php");
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