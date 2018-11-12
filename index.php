<?php
$_ROOT = getcwd();

require($_ROOT."/controller/controller.php");

try {

if (isset($_GET['action']))
{
    if ($_GET['action'] == 'signup')
        require($_ROOT."/view/signup.php");
    else if ($_GET['action'] == 'signin')
        require($_ROOT."/view/connection.php");
    else if ($_GET['action'] == 'addComment')
    {
        if (isset($_SESSION['usr_id']) && $_SESSION['usr_id'] > 0)
            if (!empty($_POST['comment']))
                addComment($_SESSION['usr_id'], $_POST['pic_id'], $_POST['comment']);
    }
}
else
    displayPictures();

} catch (Exception $e) {
    echo 'Error : ' . $e->getMessage();
}