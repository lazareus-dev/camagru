<?php ob_start(); ?>

<div class="main-montage">
    <div class="montage-cam">
        <div class="screen" id="screen">
            <video id="player" autoplay="autoplay"></video>
            <img src="" id="sticker">
        </div>
        <div id="stick_icon">
        <?php
        $i = 1;
        while ($i <= 6)
        {
            echo '<input type="image" src="/public/images/stickers/stick_'.$i.'.png" onclick=setStickerOnScreen('.$i.')>
            ';
            $i++;
        }
        ?>
        </div>
        <input type="hidden" value="2" id="sticker_id" name="sticker_id">
        <button type="submit" id="capture">capture</button>
        <canvas id="canvas" hidden></canvas>
    </div>
    <div id="gallery" class="montage-gallery">
        <div id="gallery-content"></div>
    </div>
</div>
<script src="/view/scripts/camera.js"></script>
<script src="/view/scripts/stickers_screen.js"></script>
<script src="/view/scripts/picture_process.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>