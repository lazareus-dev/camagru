function toggleLike(picId) {
    var likeBtn = document.getElementById('like' + picId);
    var nbLikesDiv = document.getElementById('nb-likes' + picId);
    var likeValue = document.getElementById('like_value' + picId);
    
    likeBtn.disabled = true;
    var isLiked = likeValue.value;

    if (window.XMLHttpRequest)
        xmlhttp = new XMLHttpRequest();
    else
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != 'Error') {
                isLiked = isLiked == 1 ? 0 : 1;
                likeValue.value = isLiked;
                if (isLiked)
                    likeBtn.src = '/public/images/like_full_icon.png';
                else
                    likeBtn.src = '/public/images/like_blank_icon.png';
                var totLikes = Number(this.responseText);
                var like = 'like';
                if (totLikes > 1) {like += 's'}
                nbLikesDiv.innerHTML = totLikes + ' ' + like;
            }
            likeBtn.disabled = false;
        }
    };
    var data = "pic_id=" + picId + "&is_liked=" + isLiked;
    xmlhttp.open("POST", "/middleware/ajax/likes.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send(data);
}