<?php ob_start(); ?>

<div class="settings-form">
    <h2 id="settings-username" ></h2>
    <input type="hidden" id="login_hint" value="<?= $_SESSION['login'] ?>">
    <form name="settings" id="settings-form" action="" method="POST">
       
       <div class="input-block"> 
        <label for="login">Login</label>
        <input type="text" id="login" name="login" required maxlength="64" value="<?= $_SESSION['login'] ?>" autocomplete="username">
       </div>

       <div class="input-block"> 
        <label for="notif">Notifications</label>
        <input type="checkbox" id="notif" name="notif" <?php if ($_SESSION['notif']){echo 'checked';}?>>
       </div>

       <div class="input-block"> 
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required maxlength="320" value="<?= $_SESSION['email'] ?>">
       </div>

       <div class="input-block"> 
        <label for="oldpasswd">Old Password</label>
        <input type="password" id="oldpasswd" name="oldpasswd" maxlength="124" autocomplete="old-password">
       </div>

       <div class="input-block"> 
        <label for="newpasswd">New Password</label>
        <input type="password" id="newpasswd" name="newpasswd" maxlength="124" require minlength="8" autocomplete="new-password">
       </div>

       <div class="input-block"> 
        <label for="apply"></label>
        <input type="submit" id="apply" name="apply" value="apply">
       </div>

    </form>
</div>

<script src="/view/scripts/settings_validation.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require("template/template.php"); ?>
