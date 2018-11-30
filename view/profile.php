<?php ob_start(); ?>

<div id="main-profile">
    <?php
        while ($pic = $picReq->fetch())
        {
            echo '<div class="gallery-pic">';
            require("profile_pic_header.php");
            echo '<img src="' . $pic[0] . '">';
            // require("pic_footer.php");
            echo '</div>';
        }
    ?>
</div>

<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>