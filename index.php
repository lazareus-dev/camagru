<!DOCTYPE html>
<html>
    <head>
        <title>Lazygram</title>
        <meta charset="utf-8" />
    </head>
    <body>
        <?php include("top_nav.php"); ?>
        <?php
            if (isset($_POST['login']))
                echo "Hello " . htmlspecialchars($_POST['login']);
            else
                include("connection.php");
        ?> 
        <?php include("footer.php"); ?>
    </body>
</html>