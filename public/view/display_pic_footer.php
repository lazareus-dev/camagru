<div class="pic-footer">
    <div class="pic-icons">
        <input type="image" id="like<?=$pic['pic_id']?>" onclick="toggleLike('<?= $pic['pic_id']?>')"
        <?php if ($is_liked == 0) echo 'src="/images/like_blank_icon.png"';
              else echo 'src="/images/like_full_icon.png"';?>>
        <input type="hidden" id="like_value<?=$pic['pic_id']?>" value="<?= $is_liked ?>"/>
        <input type="image" src="/images/comment_icon.png"> 
    </div>
    <div class="pic-likes">
        <div id="nb-likes<?=$pic['pic_id']?>"><?= $nb_likes ?>
            <?php if ($nb_likes > 1) echo 'likes'; else echo 'like'; ?>
        </div>
    </div>
    <div id="pic-comments"></div>
    <textarea rows="2" id="cmt_area" name="comment"></textarea>
    <button type="submit" id="submitCmt" name="<?= $pic['pic_id'] ?>">publish</button>
</div>
<script src="/view/scripts/comment_setter.js"></script>
<script src="/view/scripts/comment_getter.js"></script>
<script src="/view/scripts/comment_delete.js"></script>
