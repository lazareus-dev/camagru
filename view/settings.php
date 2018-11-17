<?php ob_start(); ?>

<div class="settings-form">
    <h3><?= $login ?></h3>
    <form action="index.php?action=signin" method="POST">
       <div class="input-block"> 
        <label for="login">Login</label>
        <input type="text" id="login" name="login" placeholder="<?= $login ?>">
       </div>
       <div class="input-block"> 
        <label for="notif">Mail Notifications</label>
        <input type="checkbox" name="notif">
       </div>

       <div class="input-block"> 
        <label for="passwd">Password</label>
        <input type="password" id="passwd" name="passwd">
       </div>

        <input type="submit" name="apply" value="apply">
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>