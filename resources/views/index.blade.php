<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INB - AMS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Boldonse&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-image: url('/img/pgo.jpg');
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            color: white;
            overflow: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(44, 44, 212, 0.63);
            z-index: -1;
        }

        html,
        body {
            height: 100%;
        }

        /* TITLE CONTENTS */
        .inb {
            display: flex;
            padding: 30px;
        }

        .inb img {
            max-width: 140px;
            padding-right: 10px;
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.6);
        }

        .title {
            max-width: 700px;
            line-height: 0;
        }

        .title h1 {
            font-size: 50px;
            font-family: "Boldonse", system-ui;
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.6);
        }

        .title h3 {
            font-size: 28px;
            font-family: "Boldonse", system-ui;
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.6);

        }

        /* MAIN FLEX CONTAINER */
        .main {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100vh;
        }

        /* LEFT CONTENT */
        .left {
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 50%;
            text-align: center;
        }

        .left img {
            max-width: 300px;
            position: absolute;
            top: 60%;
            left: 25%;
            transform: translate(-50%, -50%);
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.6);
        }

        /* ICONS CONTAINER */
        .icons-container {
            position: absolute;
            top: 60%;
            left: 25%;
            transform: translate(-50%, -50%);
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            width: 420px;
            height: 420px;
            border-radius: 50%;
        }

        .icons-container i {
            font-size: 3rem;
            color: white;
            position: absolute;
            transition: transform 0.3s ease;
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.6);
        }

        /* POSITION ICONS AROUND THE CENTER */
        .icons-container i:nth-child(1) {
            top: -5%;
            left: 50%;
            transform: translateX(-50%);
        }

        .icons-container i:nth-child(2) {
            top: 16%;
            left: 90%;
            transform: translateX(-50%);
        }

        .icons-container i:nth-child(3) {
            top: 45%;
            left: 100%;
            transform: translateX(-50%);
        }

        .icons-container i:nth-child(4) {
            top: 75%;
            left: 85%;
            transform: translateX(-50%);
        }

        .icons-container i:nth-child(5) {
            top: 95%;
            left: 45%;
            transform: translateY(-50%);
        }

        .icons-container i:nth-child(6) {
            top: 82%;
            left: 10%;
            transform: translateY(-50%);
        }

        .icons-container i:nth-child(7) {
            top: 45%;
            left: -5%;
            transform: translateX(50%);
        }

        .icons-container i:nth-child(8) {
            top: 15%;
            left: 0%;
            transform: translateX(50%);
        }

        .icons-container i:hover {
            transform: scale(1.2);
        }

        /* Right Container */
        .right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Style the login container */
        .login-container {
            background-color: rgba(189, 189, 189, 0.43);
            color: white;
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 500px;
            height: auto;
            box-sizing: border-box;
            padding-bottom: 50px;
            position: relative;
            top: -100px;
        }

        /* Form Styling */
        form {
            width: 100%;
        }

        label {
            font-family: "Boldonse", system-ui;
            padding: 10px;
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.6);
        }

        .login {
            font-family: "Boldonse", system-ui;
            padding-bottom: 30px;
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.6);
        }

        .log {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .alert {
            position: absolute;
            top: 5%;
            right: 13%;
            transform: translate(50%, 50%);
            z-index: 9999;
            padding: 10px 20px;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="inb">
        <div class="logo">
            <img src="{{ asset('img/iskolar-logo.png') }}" alt="INB LOGO">
        </div>
        <div class="title">
            <h1 class="mt-3">ISKOLAR NG BATAAN</h1>
            <h3 class="text-warning mt-3">ATTENDANCE MONITORING SYSTEM</h3>
        </div>
    </div>
    <div class="main">
        <div class="left">
            <img src="{{ asset('img/iskolar-logo.png') }}" alt="INB LOGO">

            <!-- Icons surrounding the logo -->
            <div class="icons-container">
                <i class="bi bi-qr-code"></i>
                <i class="bi bi-person-fill"></i>
                <i class="bi bi-calendar-check"></i>
                <i class="bi bi-camera"></i>
                <i class="bi bi-clock"></i>
                <i class="bi bi-check-circle"></i>
                <i class="bi bi-file-earmark-text"></i>
                <i class="bi bi-search"></i>
            </div>
        </div>
        <div class="right">
            <div class="login-container">
                <h2 class="login text-center text-warning">User<span class="text-white"> Login</span></h2>
                <form action="{{ url('/login') }}" method="POST">
                    @csrf <!-- CSRF token for security -->
                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ old('username') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <button type="submit" class="log btn btn-warning mt-3" style="--bs-btn-padding-y: .7rem; --bs-btn-padding-x: 6rem; --bs-btn-font-size: 1rem;">Login</button>
                </form>
            </div>
        </div>
    </div>
    @if (session('login_error'))
    <div class="alert" id="loginAlert" style="background-color: red;">
        {{ session('login_error') }}
    </div>

    <script>
        setTimeout(function() {
            const alertBox = document.getElementById('loginAlert');
            if (alertBox) {
                alertBox.style.display = 'none';
            }
        }, 3000);
    </script>
    @endif
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>