<?php ob_start(); ?>

<div class="main-montage">
    <div class="montage-cam">
        <div class="screen" id="screen">
            <video id="player" autoplay="autoplay"></video>
            <canvas id="uploaded"></canvas>
            <img src="" id="sticker">
        </div>
        <div class="upload-form" id="upload-form">
            <form method="post" action="reception.php" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                <input type="file" name="file-select" id="file-select" />
                <button type="submit" id="upload-btn">Upload</button>
            </form>
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
<?php require("template/template.php"); ?>