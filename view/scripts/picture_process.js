function pictureProcess(sticker_id) {
    var dataURL = encodeURIComponent(canvas.toDataURL('image/jpeg', 1.0));

    console.log("Sticker #" + sticker_id);

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
        }
    };
    var data = "data=" + dataURL + "&sticker_id=" + sticker_id;
    xmlhttp.open("POST", "/middleware/montage_processor.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send(data);
}
