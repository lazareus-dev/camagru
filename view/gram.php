<?php ob_start(); ?>



<?php $content = ob_get_clean(); ?>
<?php require($_ROOT."/view/template.php"); ?>