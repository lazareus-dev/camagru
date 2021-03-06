<?php ob_start(); ?>

<h2>Welcome newbie!</h2>
<div class="connect-form">
    <form action="/signup" method="POST">
        <label for="email">E-mail</label>
        <input type="email" id="email" required name="email" maxlength="320">

        <label for="login">Login</label>
        <input type="text" id="login" required name="login" maxlength="64">

        <label for="passwd">Password</label>
        <input type="password" id="passwd" maxlength="124" required name="passwd" require minlength="8">

        <input type="submit" name="signup" value="signup">
    </form>
</div>

<div class="connect-form">
    <p>Already Have An Account ? <a href="/signin">Connect here !</a></p>
</div>

<?php $content = ob_get_clean(); ?>
<?php require("template/template.php"); ?>