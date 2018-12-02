<?php ob_start(); ?>

<div class="page-not-found">
    <img src="/public/images/404.png">
</div>

<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>