<div class="pic-footer">
    <div class="pic-icons">
        <input type="image" id="like<?=$pic['pic_id']?>" onclick="toggleLike('<?= $pic['pic_id']?>')"
        <?php if ($is_liked == 0) echo 'src="/images/like_blank_icon.png"';
              else echo 'src="/images/like_full_icon.png"';?>>
        <input type="hidden" id="like_value<?=$pic['pic_id']?>" value="<?= $is_liked ?>"/>
        <input type="image" src="/images/comment_icon.png" onclick="openPicture(<?=$pic['pic_id']?>)"> 
    </div>
    <div class="pic-likes">
        <div id="nb-likes<?=$pic['pic_id']?>"><?= $nb_likes ?>
            <?php if ($nb_likes > 1) echo 'likes'; else echo 'like'; ?>
        </div>
    </div>
    <div class="pic-comments">
        <?= $nb_cmts ?>
        <?php if ($nb_cmts > 1) echo 'comments'; else echo 'comment'; ?>
    </div>
</div>