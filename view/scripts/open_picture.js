function openPicture(pictureId) {
    $url = "/index.php?action=display&pic_id=" + pictureId;
    window.open($url, "_self");
}