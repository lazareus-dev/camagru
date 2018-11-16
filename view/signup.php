<?php ob_start(); ?>

<h2>Welcome newbie!</h2>
<div class="connect-form">
    <form action="index.php" method="post">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email">

        <label for="login">Login</label>
        <input type="text" id="login" name="login">

        <label for="passwd">Password</label>
        <input type="password" id="passwd" name="passwd">

        <input type="submit" value="sign-up">
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>