<?php ob_start(); ?>

<div id="main-gallery">
<script src="/view/scripts/open_picture.js"></script>
    <?php
        while ($pic = $pictures->fetch())
        {
            $owner_id = $usrMgmt->getLoginFromId($pic['usr_id']);
            $nb_likes = $picMgmt->getNumberOfLikes($pic['pic_id'])[0];
            $nb_cmts = $picMgmt->getNumberOfComments($pic['pic_id'])[0];

            echo '<div class="gallery-pic">';
            require("gallery_pic_header.php");
            echo '<img src="' . $pic['pic_path'] . '" onclick="openPicture('. $pic['pic_id'] .')">';
            require("gallery_pic_footer.php");
            echo '</div>';
        }
    ?>
</div>

<?php $content = ob_get_clean(); ?>
<?php require($_ROOT."/view/template.php"); ?>