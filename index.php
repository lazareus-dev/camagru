<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./css/main_style.css">
        <title>Lazygru</title>
        <meta charset="utf-8" />
    </head>
    <body>
        <?php include("top_nav.php"); ?>
        <div class="main_content">
        <?php
            if (isset($_POST['login']))
                echo "Hello " . htmlspecialchars($_POST['login']);
            else
                include("connection.php");
        ?>
        </div>
        <?php include("footer.php"); ?>
    </body>
</html>