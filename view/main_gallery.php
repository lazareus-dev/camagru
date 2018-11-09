<?php ob_start(); ?>

<?= "Hello " . htmlspecialchars($_POST['login']) ?>

<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>