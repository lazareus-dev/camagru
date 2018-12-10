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

var uploadedImage = false;

captureButton.addEventListener('click', () => {
    if (!uploadedImage)
        cam_context.drawImage(player, 0, 0, cam_canvas.width, cam_canvas.height);
    pictureProcess(document.getElementById('sticker_id').value);
});
captureButton.disabled = true;

uploadForm.onsubmit = function(event) {
    event.preventDefault();
    var file = fileSelect.files[0];
    if (!file)
        return ;
    if (file.size > 2000000) {
        alert('File too big, max is 2Mo');
        return ;
    }
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
    // console.log('Camera disabled');
});

function drawUploadedImage(formData) {
    if (window.XMLHttpRequest)
        xmlhttp = new XMLHttpRequest();
    else
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp.open("POST", "/ajax/draw_upload.php", true);
    xmlhttp.onload = function() {
        if (xmlhttp.status === 200) {
            if ((this.responseText).search('ERROR') == -1) {
                up_context.clearRect(0, 0, up_canvas.width, up_canvas.height);
                cam_context.clearRect(0, 0, cam_canvas.width, cam_canvas.height);
                var toDraw = new Image();
                toDraw.onload = function() {
                    up_context.drawImage(toDraw, 0, 0, up_canvas.width, up_canvas.height);
                    cam_context.drawImage(toDraw, 0, 0, cam_canvas.width, cam_canvas.height);
                }
                toDraw.src = this.responseText;
                if (player.srcObject)
                    player.srcObject.getVideoTracks().forEach(track => track.stop());
                uploadedImage = true;
                captureButton.disabled = false;
            } else {
                var errno = (this.responseText).slice(6);
                if (errno == 'ext')
                    alert('Bad file type');
            }
            uploadBtn.innerHTML = 'Upload';
        }
    };
    xmlhttp.send(formData);
}