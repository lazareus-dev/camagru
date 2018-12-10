function promptDeletePic(picId) {
    if (confirm('Are you sure ?'))
        deletePic(picId);
}

function deletePic(picId) {
    if (window.XMLHttpRequest)
        xmlhttp = new XMLHttpRequest();
    else
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            location.reload();
        }
    };
    var data = "pic_id=" + picId;
    xmlhttp.open("POST", "/ajax/pic_delete.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send(data);
}