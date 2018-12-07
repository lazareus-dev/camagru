<?php ob_start(); ?>

<?php if (isset($login_first) && $login_first == true){ ?>
<h2>Please login first</h2>
<?php } else { ?>
<h2>Welcome back</h2>
<?php } ?>
<div class="connect-form">
    <form action="index.php?action=signin" method="POST">
        
        <label for="login">Login</label>
        <input type="text" id="login" required name="login" maxlength="64">

        <label for="passwd">Password</label>
        <input type="password" id="passwd" required name="passwd" maxlength="124">

        <input type="submit" name="signin" value="connect">
    </form>
    <a class="nodecolink" href='/index.php?action=resetpwd'> Password forgotten ?</a>
</div>

<div class="connect-form">
    <p>No Account ? <a href="/index.php?action=signup">Signup here !</a></p>
</div>

<?php $content = ob_get_clean(); ?>
<?php require("template/template.php"); ?>