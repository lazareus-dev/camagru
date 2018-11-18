<?php ob_start(); ?>

<div class="settings-form">
    <h3><?= $login ?></h3>
    <form action="index.php?action=signin" method="POST">
       
       <div class="input-block"> 
        <label for="login">Login</label>
        <input type="text" id="login" name="login" value="<?= $login ?>">
       </div>

       <div class="input-block"> 
        <label for="notif">Notifications</label>
        <input type="checkbox" name="notif" <?php if ($notif){echo 'checked';}?>>
       </div>

       <div class="input-block"> 
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= $email ?>">
       </div>

       <div class="input-block"> 
        <label for="oldpasswd">Old Password</label>
        <input type="password" id="oldpasswd" name="oldpasswd">
       </div>

       <div class="input-block"> 
        <label for="newpasswd">New Password</label>
        <input type="password" id="newpasswd" name="newpasswd">
       </div>

       <div class="input-block"> 
        <label for="apply"></label>
        <input type="submit" id="apply" name="apply" value="apply">
       </div>

    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>