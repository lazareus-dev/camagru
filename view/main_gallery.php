<?php ob_start(); ?>

<?= "Hello you're alone" ?>

<?php $content = ob_get_clean(); ?>
<?php require($_ROOT."/view/template.php"); ?>