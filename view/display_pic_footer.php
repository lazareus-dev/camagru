<div class="pic-footer">
    <div class="pic-icons">
        <img src="/public/images/like_blank_icon.png"> 
        <img src="/public/images/comment_icon.png"> 
    </div>
    <div class="pic-likes">
        <?= $nb_likes ?>
        <?php if ($nb_likes > 1) echo 'likes'; else echo 'like'; ?>
    </div>
    <div id="pic-comments">
        comments
    </div>
    <textarea rows="2" id="cmt_area" name="comment"></textarea>
    <button type="submit" id="submitCmt" name="<?= $pic['pic_id'] ?>">publish</button>
</div>
<script src="/view/scripts/comment_process.js"></script>
