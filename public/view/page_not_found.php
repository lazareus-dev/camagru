<?php ob_start(); ?>

<div class="page-not-found">
    <img src="/images/404.png">
</div>

<?php $content = ob_get_clean(); ?>
<?php require("template/template.php"); ?>