var i = 0;

while (i < 6)
{
    var img = document.createElement("img");
    img.src = "/public/images/sticker-placeholder.jpg";
    var src = document.getElementById("stickers");
    src.appendChild(img);
    i++;
}