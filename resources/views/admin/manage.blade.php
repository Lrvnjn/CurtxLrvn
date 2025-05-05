<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Activity</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Boldonse&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Navbar */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
        }

        .title {
            display: flex;
            align-items: center;
            margin-right: 50px;
        }

        .title img {
            max-width: 80px;
            padding: 10px;
        }

        .title a {
            font-family: "Anton", sans-serif;
            text-decoration: none;
            color: #034C53;
            font-size: 45px;
        }

        .pages {
            display: flex;
            gap: 50px;
        }

        .pages a {
            font-family: "Boldonse", system-ui;
            text-decoration: none;
            color: #143D60;
            font-size: 20px;
        }

        .logout {
            margin-left: auto;
        }

        /* Header */
        .mana {
            display: flex;
            justify-content: space-between;
        }

        .man {
            font-family: "Boldonse", system-ui;
            font-size: 25px;
            padding: 20px;
        }

        .act {
            font-size: 30px;
        }

        .back {
            padding: 20px;
            color: rgb(32, 31, 31);
        }

        .scan {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .camera {
            height: 350px;
            width: 350px;
            background-color: #034C53;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        #camera-container {
            width: 100%;
            height: 100%;
            background-color: #fff;
        }

        #start-camera {
            position: absolute;
            bottom: 20px;
            z-index: 10;
        }
    </style>
</head>

<body>
    <nav class="navbar" style="background-color: #e3f2fd;">
        <div class="title">
            <img src="{{ asset('img/iskolar-logo.png') }}" alt="INB LOGO">
            <a href="">INB - AMS</a>
        </div>
        <div class="pages">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('activities') }}">Activities</a>
            <a href="{{ route('users') }}">Users</a>
            <a href="{{ route('generateqr') }}">Generate</a>
            <a href="{{ route('report') }}">Reports</a>
        </div>
        <div class="logout ms-auto me-4">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-dark">LOG OUT</button>
            </form>
        </div>
    </nav>
    <div class="mana">
        <h2 class="man">Manage >><span class="act"> {{ $activity->activity_name }}</span></h2>
        <a href="{{ route('activities') }}" class="back"><i class="bi bi-arrow-left-circle-fill fs-1"></i></a>
    </div>
    <div class="scan">
        <div class="camera">
            <div id="camera-container" style="width: 100%; height: 100%;"></div>
        </div>
        <button type="submit" class="btn btn-primary mt-2" id="start-camera">SCAN NOW!</button>
        <input type="text" id="qr-code-result" class="form-control mt-3" placeholder="QR Code Result" readonly />
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    // QR CODE SCANNER
    document.addEventListener("DOMContentLoaded", () => {
        const button = document.getElementById('start-camera');
        const qrInput = document.getElementById('qr-code-result');
        const scannerId = "camera-container";

        let isScanning = false;
        let html5QrCode;

        button.addEventListener("click", () => {
            if (isScanning) return; // prevent reinitializing
            isScanning = true;

            html5QrCode = new Html5Qrcode(scannerId);

            html5QrCode.start({
                    facingMode: "environment"
                }, // back camera
                {
                    fps: 10,
                    qrbox: 250
                },
                (decodedText) => {
                    qrInput.value = decodedText;
                    html5QrCode.stop().then(() => {
                        isScanning = false;
                    }).catch(err => console.error("Stop error", err));
                },
                (errorMessage) => {
                    // QR not found in frame, ignore
                }
            ).catch(err => {
                console.error("Camera error:", err);
                alert("Camera access failed. Please check your browser permissions.");
                isScanning = false;
            });
        });
    });
</script>

</html>