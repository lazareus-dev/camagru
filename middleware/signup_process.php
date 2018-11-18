<?php

require_once($_ROOT."/model/UserManager.php");

$login = "";
$email = "";
$passwd = "";
$regex = '$S*(?=S{8,})(?=S*[a-z])(?=S*[A-Z])(?=S*[d])(?=S*[W])S*$';

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
        // else if (!preg_match($regex, $_POST['passwd']))
        // {
        //     $message='Password must contain at least : 1 uppercase, 1 lowercase, 1 number, 1 special character';
        //     echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
        //     require($_ROOT."/view/signup.php");
        // }
        else
        {
            $passwd = hash('Whirlpool', $_POST['passwd']);
            $user->createUser($login, $email, $passwd);
            header('Location: /index.php');
        }
    }
}
else
    require($_ROOT."/index.php?action=signup");