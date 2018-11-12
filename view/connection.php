<?php ob_start(); ?>

<div class="connect-form">
    <form action="index.php" method="post">
        <label for="login">Login</label>
        <input type="text" id="login" name="login">

        <label for="passwd">Password</label>
        <input type="password" id="passwd" name="passwd">

        <input type="submit" value="connect">
    </form>
</div>

<div class="connect-form">
    <p>No Account ? <a href="/index.php?action=signup">Signup here !</a></p>
</div>

<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>