const submitBtn = document.getElementById('submitCmt');
const cmtArea = document.getElementById('cmt_area');

submitBtn.addEventListener('click', () => {
    addComment();
});

function addComment() {
    if (!cmtArea.value || cmtArea.value === "" || cmtArea.value.trim() == "") {
        cmtArea.value = "";
        cmtArea.focus();
        return false;
    }
    submitBtn.innerHTML = "sending...";
    submitBtn.disabled = true;
    if (window.XMLHttpRequest)
        xmlhttp = new XMLHttpRequest();
    else
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            cmtArea.value = "";
            updateCommentDisplay();
            submitBtn.innerHTML = "publish";
            submitBtn.disabled = false;
        }
    };
    var data = "pic_id=" + submitBtn.name + "&comment=" + cmtArea.value;
    xmlhttp.open("POST", "/middleware/comment_setter.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send(data);
}