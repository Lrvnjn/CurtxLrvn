<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Boldonse&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
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

        h1 {
            padding: 20px;
            font-family: "Boldonse", system-ui;
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
            <a href="{{ route('staff.dashboard') }}">Dashboard</a>

        </div>
        <div class="logout ms-auto me-4">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-dark">LOG OUT</button>
            </form>
        </div>
    </nav>
    <h1>Welcome to INB Staff Dashboard!</h1>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    const logoutUrl = "{{ route('logout') }}";

    function logout() {
        fetch(logoutUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    _method: 'POST',
                })
            })
            .then(response => {
                if (response.ok) {
                    window.location.href = '/';
                }
            })
            .catch(error => console.error('Logout failed:', error));
    }
</script>

</html>