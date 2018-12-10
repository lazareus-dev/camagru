const mail_input = document.getElementById('email');
const form = document.getElementById('mail-reset-form');

form.onsubmit = function(event) {
    event.preventDefault();
    var mail = mail_input.value;
    if (mail.trim() == "")
        return false;
    sendResetMail(mail);
}

function sendResetMail(mail) {
    if (window.XMLHttpRequest)
        xmlhttp = new XMLHttpRequest();
    else
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
        }
    };
    var data = "mail=" + mail;
    xmlhttp.open("POST", "/ajax/pwd_reset_mail.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send(data);
}