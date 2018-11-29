var i = 1;

const stick_icons_div = document.getElementById("stick_icon");
while (i < 7)
{
    var img = document.createElement("input");
    img.type = "image";
    img.src = "/public/images/stickers/stick_" + i + ".png";
    img.id = "stick_" + i;
    stick_icons_div.appendChild(img);
    img.onclick = "setStickerOnScreen("+i+")";
    i++;
}
