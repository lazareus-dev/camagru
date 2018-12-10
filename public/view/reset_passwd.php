<?php ob_start(); ?>

<div class="connect-form">
    <form id="reset-form" action="" method="POST">
        <label for="newpasswd">New Password</label>
        <input type="password" id="newpasswd" name="newpasswd" maxlength="124" required require minlength="8">

        <label for="newpasswd2">Confirm Password</label>
        <input type="password" id="newpasswd2" name="newpasswd2" maxlength="124" required require minlength="8" autocomplete="password">
        
        <label for="reset"></label>
        <input type="submit" id="reset" name="reset" value="reset">
    </form>
    <input type="hidden" id="resetkey" name="resetkey" value="<?= $_GET['resetkey'] ?>">
    <a class="nodecolink" href='/index.php?action=signin'>Back to sign-in</a>
</div>

<div class="connect-form">
    <p>No Account ? <a href="/index.php?action=signup">Signup here !</a></p>
</div>
<script src="/view/scripts/reset_passwd.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require("template/template.php"); ?>