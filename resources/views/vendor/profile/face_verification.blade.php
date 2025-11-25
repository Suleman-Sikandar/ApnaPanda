<div class="content-section">
    <div class="section-header">
        <h2 class="section-title">Face Verification</h2>
        <p style="color: #6b7280; font-size: 14px;">Verify your identity to complete registration</p>
    </div>

    @if($vendor->is_face_verified)
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> Your identity has been verified successfully!
        </div>
    @else
        <div style="max-width: 600px; margin: 0 auto;">
            <div style="position: relative; margin-bottom: 20px;">
                <video id="video" width="100%" height="400" autoplay style="border-radius: 10px; background: #000;"></video>
                <canvas id="overlay" style="position: absolute; top: 0; left: 0; border-radius: 10px;"></canvas>
            </div>

            <div id="verification-status" class="alert" style="display: none;"></div>

            <button type="button" id="start-verification-btn" class="save-btn" style="width: 100%;">
                <i class="fas fa-camera"></i> Start Verification
            </button>
        </div>
    @endif
</div>

@push('scripts')
<!-- Face API -->
<script defer src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>

<script>
    const video = document.getElementById('video');
    const startBtn = document.getElementById('start-verification-btn');
    const statusDiv = document.getElementById('verification-status');
    
    if (startBtn) {
        startBtn.addEventListener('click', async () => {
            startBtn.disabled = true;
            statusDiv.style.display = 'block';
            statusDiv.innerText = 'Loading models...';

            try {
                await Promise.all([
                    faceapi.nets.tinyFaceDetector.loadFromUri('https://justadudewhohacks.github.io/face-api.js/models'),
                    faceapi.nets.faceLandmark68Net.loadFromUri('https://justadudewhohacks.github.io/face-api.js/models'),
                    faceapi.nets.faceRecognitionNet.loadFromUri('https://justadudewhohacks.github.io/face-api.js/models'),
                    faceapi.nets.ssdMobilenetv1.loadFromUri('https://justadudewhohacks.github.io/face-api.js/models')
                ]);

                statusDiv.innerText = 'Starting camera...';
                startVideo();
            } catch (err) {
                console.error(err);
                statusDiv.innerText = 'Error loading models. Please reload and try again.';
                statusDiv.className = 'alert alert-danger';
            }
        });
    }

    function startVideo() {
        navigator.mediaDevices.getUserMedia({ video: {} })
            .then(stream => {
                video.srcObject = stream;
                statusDiv.innerText = 'Detecting face... Please look at the camera.';
            })
            .catch(err => {
                console.error(err);
                statusDiv.innerText = 'Unable to access camera.';
                statusDiv.className = 'alert alert-danger';
            });
    }

    if (video) {
        video.addEventListener('play', () => {
            const canvas = document.getElementById('overlay');
            const displaySize = { width: video.width, height: video.height };
            faceapi.matchDimensions(canvas, displaySize);

            setInterval(async () => {
                const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceDescriptors();
                const resizedDetections = faceapi.resizeResults(detections, displaySize);
                canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
                faceapi.draw.drawDetections(canvas, resizedDetections);

                if (detections.length > 0) {
                    statusDiv.className = 'alert alert-success';
                    statusDiv.innerText = 'Face detected! Verifying...';

                    setTimeout(() => {
                        verifyFace(detections[0].descriptor);
                    }, 2000);
                }
            }, 100);
        });
    }

    async function verifyFace(descriptor) {
        try {
            const response = await fetch('{{ route("vendor.face.verification", $vendor->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({})
            });

            const result = await response.json();

            if (result.success) {
                statusDiv.innerText = result.message;
                setTimeout(() => {
                    window.location.href = '{{ route("vendor.home") }}';
                }, 1500);
            } else {
                statusDiv.className = 'alert alert-danger';
                statusDiv.innerText = result.message;
            }
        } catch (error) {
            console.error(error);
            statusDiv.className = 'alert alert-danger';
            statusDiv.innerText = 'Verification failed. Please try again.';
        }
    }
</script>
@endpush
