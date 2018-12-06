const username_h = document.getElementById('settings-username');
const login = document.getElementById('login_hint');
const settings_form = document.getElementById('settings-form');
const login_input = document.getElementById('login');
const mail_input = document.getElementById('email');
const oldpwd_input = document.getElementById('oldpasswd');
const newpwd_input = document.getElementById('newpasswd');
const notif_box = document.getElementById('notif');

updateLogin();

var orig_login = login.value;
var orig_mail = mail_input.value;
var orig_notif = notif_box.checked;


settings_form.onsubmit = function (event) {
    event.preventDefault();
    var newpasswd = newpwd_input.value;
    var oldpasswd = oldpwd_input.value;
    if (newpasswd != "" && oldpasswd == "") {
        alert("Please fill in your old password to modify it");
        document.getElementById('oldpasswd').focus();
        return false;
    }
    settingsValidation();
    updateLogin();
    return true;
}

function updateLogin() {
    var usrname = login.value;
    username_h.innerHTML = usrname;
}

function settingsValidation() {
    var new_login = login_input.value;
    var new_mail = mail_input.value;
    var new_notif = notif_box.checked;
    var newpasswd = newpwd_input.value;
    var oldpasswd = oldpwd_input.value;
    var data = "";

    if (new_login != orig_login)
    {
        data += "login=" + new_login;
        login.value = new_login;
        orig_login = new_login;
    }
    if (new_mail != orig_mail)
    {
        if (data != "") data += '&';
        data += "email=" + new_mail;
        orig_mail = new_mail;
    }
    if (new_notif != orig_notif)
    {
        if (data != "") data += '&';
        data += "notif=" + new_notif;
        orig_notif = new_notif;
    }
    if (newpasswd != "" && oldpasswd != "")
    {
        if (data != "") data += '&';
        data += "newpasswd=" + newpasswd + "&oldpasswd=" + oldpasswd;
    }
    if (data != "")
        applySettings(data);
    else
        alert("No changes to apply");
}

function applySettings(data) {
    if (window.XMLHttpRequest)
        xmlhttp = new XMLHttpRequest();
    else
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
        }
    };
    xmlhttp.open("POST", "/middleware/ajax/settings_setter.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send(data);
}