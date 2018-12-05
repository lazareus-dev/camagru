const askResetForm = document.getElementById('reset-form');
var pwdInput = document.getElementById('newpasswd');
var pwdInput2 = document.getElementById('newpasswd2');
var resetKey = document.getElementById('resetkey');

askResetForm.onsubmit = function(event) {
    event.preventDefault();
    pwd = pwdInput.value;
    pwd2 = pwdInput2.value;
    if (pwd != pwd2)
    {
        pwdInput2.value = "";
        pwdInput2.focus();
        alert('Wrong password confirmation');
    }
    else
        resetPasswd(pwd, resetKey);
}

function resetPasswd(pwd, resetKey) {
    if (window.XMLHttpRequest)
        xmlhttp = new XMLHttpRequest();
    else
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
        }
    };
    var data = "pwd=" + pwd + "&resetkey=" + resetKey;
    xmlhttp.open("POST", "/middleware/ajax/pwd_resetter.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send(data);
}