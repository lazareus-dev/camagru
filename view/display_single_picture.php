<?php ob_start(); ?>

<div id="main-gallery">
<script src="/view/scripts/likes.js"></script>
    <div class="gallery-pic">
        <?php require(__DIR__."/main_gallery/gallery_pic_header.php"); ?>
        <img src="<?= $pic['pic_path'] ?>">
        <?php require(__DIR__."/display_pic_footer.php"); ?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require($_ROOT."/view/template/template.php"); ?>