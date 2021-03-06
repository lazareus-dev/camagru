<?php ob_start(); ?>

<div class="connect-form">
    <form id="mail-reset-form" action="" method="POST">
        
        <label for="email">E-mail</label>
        <input type="email" id="email" required name="email" maxlength="320">

        <input type="submit" id="submit" name="signin" value="send activation link">
    </form>
    <a class="nodecolink" href='/signin'>Back to sign-in</a>
</div>

<div class="connect-form">
    <p>No Account ? <a href="/signup">Signup here !</a></p>
</div>
<script src="/view/scripts/reset_passwd_mail.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require("template/template.php"); ?>