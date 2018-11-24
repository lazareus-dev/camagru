<?php ob_start(); ?>

<div class="main-montage">
    <div class="montage-cam">
        <video id="player" autoplay="autoplay"></video>
        <div id="stickers">
        </div>
        <button id="capture">capture</button>
        <canvas id="canvas"></canvas>
        <script src="/view/scripts/camera.js"></script>
        <script src="/view/scripts/stickers_impl.js"></script>
    </div>
    <div class="montage-gallery">
        Your gallery
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>