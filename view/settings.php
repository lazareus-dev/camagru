<?php ob_start(); ?>



<div class="settings-form">
    <h2><?= $_SESSION['login'] ?></h2>
    <form name="settings" action="index.php?action=settings"
    onsubmit="return validateForm()" method="POST">
       
       <div class="input-block"> 
        <label for="login">Login</label>
        <input type="text" id="login" name="login" value="<?= $_SESSION['login'] ?>">
       </div>

       <div class="input-block"> 
        <label for="notif">Notifications</label>
        <input type="checkbox" name="notif" <?php if ($_SESSION['notif']){echo 'checked';}?>>
       </div>

       <div class="input-block"> 
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= $_SESSION['email'] ?>">
       </div>

       <div class="input-block"> 
        <label for="oldpasswd">Old Password</label>
        <input type="password" id="oldpasswd" name="oldpasswd">
       </div>

       <div class="input-block"> 
        <label for="newpasswd">New Password</label>
        <input type="password" id="newpasswd" name="newpasswd" require minlength="8">
       </div>

       <div class="input-block"> 
        <label for="apply"></label>
        <input type="submit" id="apply" name="apply" value="apply">
       </div>

    </form>
</div>

<script>
function validateForm() {
    var newpasswd = document.forms['settings']['newpasswd'].value;
    var oldpasswd = document.forms['settings']['oldpasswd'].value;
    if (newpasswd != "" && oldpasswd == "") {
        alert("Please fill in your old password to modify it");
        document.getElementById('oldpasswd').focus();
        return false;
    }
}
</script>

<?php $content = ob_get_clean(); ?>
<?php require("template/template.php"); ?>
