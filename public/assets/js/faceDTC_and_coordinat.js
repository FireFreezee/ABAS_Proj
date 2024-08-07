// webcam and face detection
let image = '';
let isCameraOn = true;
let faceConfidence = 0;

async function loadModels() {
    const MODEL_URL = '/assets/models'; // Path to models directory
    try {
        await faceapi.nets.ssdMobilenetv1.loadFromUri(MODEL_URL);
        await faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL);
        await faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL);
        console.log('Models loaded successfully.');
    } catch (error) {
        console.error('Error loading models:', error);
    }
}

// Function to detect faces and draw detections
async function detectFaces() {
    const input = document.getElementById('result');
    const canvas = document.getElementById('faceCanvas');

    if (!input || !canvas) {
        console.error('Image or canvas element not found.');
        return;
    }

    const displaySize = { width: input.width, height: input.height };
    faceapi.matchDimensions(canvas, displaySize);

    try {
        let fullFaceDescriptions = await faceapi.detectAllFaces(input).withFaceLandmarks().withFaceDescriptors();
        fullFaceDescriptions = faceapi.resizeResults(fullFaceDescriptions, displaySize);

        faceapi.draw.drawDetections(canvas, fullFaceDescriptions);

        // Calculate average face confidence
        if (fullFaceDescriptions.length > 0) {
            const detections = fullFaceDescriptions.map(fd => fd.detection.score);
            faceConfidence = Math.max(...detections); // Get the highest confidence
        } else {
            faceConfidence = 0; // No face detected
        }
    } catch (error) {
        console.error('Error detecting faces:', error);
    }
}

// Start Camera


Webcam.set({
    height: 450,
    width: 600,
    image_format: 'jpeg',
    jpeg_quality: 90,
    flip_horiz: true
});
Webcam.attach('#webcamCapture');



// Take Snapshot
document.getElementById('takeSnapshot').addEventListener('click', async function () {
    if (isCameraOn) {
        Webcam.snap(async function (data_uri) {
            image = data_uri;
            const resultImg = document.getElementById('result');
            resultImg.src = data_uri;
            document.getElementById('webcamCapture').style.display = 'none';
            resultImg.style.display = 'block'; // Show result image

            // Ensure the canvas is visible and correctly resized
            const canvas = document.getElementById('faceCanvas');
            if (canvas) {
                canvas.width = resultImg.width;
                canvas.height = resultImg.height;
                canvas.style.display = 'block'; // Show canvas
            }

            await detectFaces();
        });
    } else {
        alert('Kamera belum dimulai.');
    }
});


// Reset Camera
document.getElementById('resetCamera').addEventListener('click', function () {
    if (!isCameraOn) {
        Webcam.attach('#webcamCapture');
        isCameraOn = true;
    }
    document.getElementById('webcamCapture').style.display = 'block';
    document.getElementById('result').style.display = 'none';
    // Clear the canvas
    const canvas = document.getElementById('faceCanvas');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear the canvas
    }
});

// Load models when the page loads
window.onload = async function () {
    await loadModels();
};


function jarak() {
    // map
    var lokasi = document.getElementById('lokasi');
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    }
    
    
    function successCallback(position) {
        var lokasi = document.getElementById('lokasi');
        lokasi.value = position.coords.latitude + "," + position.coords.longitude;
    
        // Use the variables from the inline script
        var lokasi_sekolah = lokasiSekolah;
        var radius = radiusSekolah;
    
        var lok = lokasi_sekolah.split(",");
        var lat_sekolah = lok[0];
        var long_sekolah = lok[1];
        var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 17);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
        var circle = L.circle([lat_sekolah, long_sekolah], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: radius
        }).addTo(map);
    }
    
    function errorCallback(params) {
    
    }
}setInterval(jarak, 1000);


$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });

    $("#absen").click(function (e) {
        var lokasi = $('#lokasi').val();
        var image = $('#result').attr('src'); // Use the src attribute to get the image data

        $.ajax({
            type: 'POST',
            url: '/absen/store',
            data: {
                image: image,
                lokasi: lokasi,
                faceConfidence: faceConfidence
            },
            cache: false,
            success: function (respond) {
                var status = respond.split("|")
                if (status[0] == "success") {
                    Swal.fire({
                        title: "Berhasil",
                        text: status[1],
                        icon: "success"
                    });
                    setTimeout("location.href='/siswa'", 3000)
                } else {
                    Swal.fire({
                        title: "Gagal",
                        text: status[1],
                        icon: "error"
                    });
                }
            },
            error: function (xhr) {
                console.error('Error:', xhr.responseText); // Handle error response
            }
        });
    });
});
