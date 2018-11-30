<?php ob_start(); ?>

<div id="main-gallery">
    <div class="gallery-pic">
        <?php require("gallery_pic_header.php"); ?>
        <img src="<?= $pic['pic_path'] ?>">
        <?php require("display_pic_footer.php"); ?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require($_ROOT."/view/template.php"); ?>