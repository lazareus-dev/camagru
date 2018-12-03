const cmtDisplay = document.getElementById('pic-comments');

updateCommentDisplay();

function displayComments(content) {
    cmtDisplay.innerHTML = content;
}

function updateCommentDisplay() {
    if (window.XMLHttpRequest)
        xmlhttp = new XMLHttpRequest();
    else
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            displayComments(this.responseText);
        }
    };
    var data = "pic_id=" + submitBtn.name;
    xmlhttp.open("POST", "/middleware/comment_getter.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send(data);
}