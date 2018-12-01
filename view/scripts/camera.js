const player = document.getElementById('player');
const canvas = document.getElementById('canvas');
const context = canvas.getContext('2d');
const captureButton = document.getElementById('capture');

const width = 600;
const scaleFactor = width / 427;
canvas.width = width;
canvas.height = 320 * scaleFactor;

const constraints = {
    video: true,
    audio: false
};

captureButton.addEventListener('click', () => {
    // Draw the video frame to the canvas.
    context.drawImage(player, 0, 0, canvas.width, canvas.height);
    pictureProcess(document.getElementById('sticker_id').value);
});

// Attach the video stream to the video element and autoplay.
navigator.mediaDevices.getUserMedia(constraints).then((stream) => {
    player.srcObject = stream;
});
