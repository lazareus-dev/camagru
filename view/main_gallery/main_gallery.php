<?php ob_start(); ?>

<div id="main-gallery">
<?php if (isset($_SESSION['usr_id']) && $_SESSION['usr_id'] > 0) { ?>
<h1>Hello <?= $usrMgmt->getLoginFromId($_SESSION['usr_id']); ?></h1>
<?php } else { ?>
<h1>Hello <?= 'visitor' ?></h1>
<?php } ?>

<script src="/view/scripts/open_picture.js"></script>
<?php include("navigation.php"); ?> 
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

<?php include("navigation.php"); ?> 
</div>
<?php $content = ob_get_clean(); ?>
<?php require($_ROOT."/view/template/template.php"); ?>