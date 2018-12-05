<?php ob_start(); ?>

<div class="connect-form">
    <form id="ask-reset-form" action="" method="POST">
        
        <label for="email">E-mail</label>
        <input type="email" id="email" required name="email">

        <input type="submit" name="signin" value="send activation link">
    </form>
    <a class="nodecolink" href='/index.php?action=signin'>Back to sign-in</a>
</div>

<div class="connect-form">
    <p>No Account ? <a href="/index.php?action=signup">Signup here !</a></p>
</div>
<script src="/view/scripts/reset_passwd.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require("template/template.php"); ?>