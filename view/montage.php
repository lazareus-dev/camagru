<?php ob_start(); ?>

<div class="main-montage">
    <div class="montage-cam">
        <video id="player" autoplay="autoplay"></video>
        <button id="capture">Capture</button>
        <canvas id="canvas"></canvas>
        <script src="/view/scripts/camera.js"></script>
    </div>
    <div class="montage-gallery">
        lkjsdflkj
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>