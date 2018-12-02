<div class="pic-footer">
    <div class="pic-icons">
        <img src="/public/images/like_blank_icon.png"> 
        <img src="/public/images/comment_icon.png"> 
    </div>
    <div class="pic-likes">
        <?= $nb_likes ?>
        <?php if ($nb_likes > 1) echo 'likes'; else echo 'like'; ?>
    </div>
    <div class="pic-comments">
        <?= $nb_cmts ?>
        <?php if ($nb_cmts > 1) echo 'comments'; else echo 'comment'; ?>
    </div>
</div>