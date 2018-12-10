setStickerOnScreen(2);

function setStickerOnScreen(stickerId) {
    const sticker = document.getElementById("sticker");
    const sticker_id = document.getElementById("sticker_id");
    sticker.src = "/images/stickers/stick_" + stickerId + ".png";
    sticker_id.value = stickerId;
}