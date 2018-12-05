<?php ob_start(); ?>

<div id="main-profile">
<script src="/view/scripts/open_picture.js"></script>
    <?php
        if ($picReq->rowCount() == 0)
            echo '<a href="/index.php?action=montage">Try taking pictures up here !</a>';
        while ($pic = $picReq->fetch())
        {
            $nb_likes = $picMgmt->getNumberOfLikes($pic['pic_id'])[0];
            $nb_cmts = $picMgmt->getNumberOfComments($pic['pic_id'])[0];

            echo '<div class="gallery-pic">';
            require("profile_pic_header.php");
            echo '<img src="' . $pic['pic_path'] . '" onclick="openPicture('. $pic['pic_id'] .')">';
            require("profile_pic_footer.php");
            echo '</div>';
        }
    ?>
</div>

<?php $content = ob_get_clean(); ?>
<?php require("template/template.php"); ?>