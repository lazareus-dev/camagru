const miniGallery = document.getElementById('gallery-content');

updateMiniGallery();

function pictureProcess(sticker_id) {
    var dataURL = encodeURIComponent(canvas.toDataURL('image/jpeg', 1.0));

    if (window.XMLHttpRequest)
        xmlhttp = new XMLHttpRequest();
    else
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            updateMiniGallery();
        }
    };
    var data = "img_data=" + dataURL + "&sticker_id=" + sticker_id;
    xmlhttp.open("POST", "/middleware/montage_processor.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send(data);
}

function displayMiniGallery(content) {
    miniGallery.innerHTML = content;
}

function updateMiniGallery() {
    if (window.XMLHttpRequest)
        xmlhttp = new XMLHttpRequest();
    else
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log('UPDATE MINI GALLERY');
            displayMiniGallery(this.responseText);
        }
    };
    xmlhttp.open("GET", "/middleware/miniGallery_getter.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send();
}
