const screen = document.getElementById('screen');

const up_canvas = document.getElementById('uploaded');
const up_context = up_canvas.getContext('2d');
const uploadForm = document.getElementById('upload-form');
const fileSelect = document.getElementById('file-select');
const uploadBtn = document.getElementById('upload-btn');

const player = document.getElementById('player');
const cam_canvas = document.getElementById('canvas');
const cam_context = canvas.getContext('2d');
const captureButton = document.getElementById('capture');

const width = 600;
const scaleFactor = width / 427;
up_canvas.width = width;
up_canvas.height = 320 * scaleFactor;
cam_canvas.width = width;
cam_canvas.height = 320 * scaleFactor;

const constraints = {
    video: true,
    audio: false
};

captureButton.addEventListener('click', () => {
    // Draw the video frame to the canvas.
    cam_context.drawImage(player, 0, 0, cam_canvas.width, cam_canvas.height);
    pictureProcess(document.getElementById('sticker_id').value);
});
captureButton.disabled = true;

uploadForm.onsubmit = function(event) {
    event.preventDefault();
    var file = fileSelect.files[0];
    if (!file)
        return ;
    uploadBtn.innerHTML = 'Uploading';
    var formData = new FormData();
    formData.append('up_file', file, file.name);
    drawUploadedImage(formData);
}

// Attach the video stream to the video element and autoplay.
navigator.mediaDevices.getUserMedia(constraints).then((stream) => {
    player.srcObject = stream;
    captureButton.disabled = false;
}).catch(function(err) {
    console.log('Camera disabled');
});

function drawUploadedImage(formData) {
    if (window.XMLHttpRequest)
        xmlhttp = new XMLHttpRequest();
    else
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp.open("POST", "/middleware/draw_upload.php", true);
    xmlhttp.onload = function() {
        if (xmlhttp.status === 200) {
            alert(this.responseText);
            var toDraw = new Image();
            toDraw.src = this.responseText;
            cam_context.drawImage(toDraw, 0, 0, cam_canvas.width, cam_canvas.height);
            // up_context.drawImage(toDraw, 0, 0, up_canvas.width, up_canvas.height);
            uploadBtn.innerHTML = 'Upload';
            if (this.responseText != 'ERROR')
                captureButton.disabled = false;
        }
    };
    xmlhttp.send(formData);
}