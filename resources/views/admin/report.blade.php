<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Reports</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Boldonse&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Nav */
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

        .head {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        h3 {
            font-family: "Boldonse", system-ui;
            color: #143D60;
        }

        /* Report Table */
        .report-list {
            padding: 20px;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .table th {
            background-color: #e3f2fd;
        }

        .badge {
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <nav class="navbar sticky-top" style="background-color: #e3f2fd;">
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
        <div class="logout me-4">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-dark" onclick="logout()">LOG OUT</button>
            </form>
        </div>
    </nav>
    <div class="head">
        <h3>Provincial Activity Reports</h3>
        <div class="dropdown">
            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Filter
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Monthly</a></li>
                <li><a class="dropdown-item" href="#">Yearly</a></li>
                <li><a class="dropdown-item" href="#">All time</a></li>
            </ul>
        </div>
    </div>
    <!-- Sample Provincial Report Table -->
    <div class="report-list">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Activity Name</th>
                    <th>Date</th>
                    <th>Participants</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample Report Data -->
                <tr>
                    <td>Community Cleanup</td>
                    <td>2025-03-25</td>
                    <td>120</td>
                    <td><span class="badge bg-success">Completed</span></td>
                    <td class="action-buttons">
                        <button class="btn btn-dark btn-sm">View PDF</button>
                        <button class="btn btn-warning btn-sm">Download</button>
                    </td>
                </tr>
                <tr>
                    <td>Charity Event</td>
                    <td>2025-04-01</td>
                    <td>80</td>
                    <td><span class="badge bg-success">Approved</span></td>
                    <td class="action-buttons">
                        <button class="btn btn-dark btn-sm">View PDF</button>
                        <button class="btn btn-warning btn-sm">Download</button>
                    </td>
                </tr>
                <tr>
                    <td>Sports Festival</td>
                    <td>2025-05-10</td>
                    <td>200</td>
                    <td><span class="badge bg-info">Scheduled</span></td>
                    <td class="action-buttons">
                        <button class="btn btn-dark btn-sm">View PDF</button>
                        <button class="btn btn-warning btn-sm">Download</button>
                    </td>
                </tr>
                <tr>
                    <td>Food Drive</td>
                    <td>2025-06-05</td>
                    <td>150</td>
                    <td><span class="badge bg-danger">Cancelled</span></td>
                    <td class="action-buttons">
                        <button class="btn btn-dark btn-sm">View PDF</button>
                        <button class="btn btn-warning btn-sm">Download</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="head">
        <h3>Municipal Activity Reports</h3>
        <div class="dropdown">
            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Filter
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Monthly</a></li>
                <li><a class="dropdown-item" href="#">Yearly</a></li>
                <li><a class="dropdown-item" href="#">All time</a></li>
            </ul>
        </div>
    </div>
    <!-- Sample Municipal Report Table -->
    <div class="report-list">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Activity Name</th>
                    <th>Date</th>
                    <th>Participants</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample Report Data -->
                <tr>
                    <td>Community Cleanup</td>
                    <td>2025-03-25</td>
                    <td>120</td>
                    <td><span class="badge bg-success">Completed</span></td>
                    <td class="action-buttons">
                        <button class="btn btn-dark btn-sm">View PDF</button>
                        <button class="btn btn-warning btn-sm">Download</button>
                    </td>
                </tr>
                <tr>
                    <td>Charity Event</td>
                    <td>2025-04-01</td>
                    <td>80</td>
                    <td><span class="badge bg-warning">Upcoming</span></td>
                    <td class="action-buttons">
                        <button class="btn btn-dark btn-sm">View PDF</button>
                        <button class="btn btn-warning btn-sm">Download</button>
                    </td>
                </tr>
                <tr>
                    <td>Sports Festival</td>
                    <td>2025-05-10</td>
                    <td>200</td>
                    <td><span class="badge bg-info">Scheduled</span></td>
                    <td class="action-buttons">
                        <button class="btn btn-dark btn-sm">View PDF</button>
                        <button class="btn btn-warning btn-sm">Download</button>
                    </td>
                </tr>
                <tr>
                    <td>Food Drive</td>
                    <td>2025-06-05</td>
                    <td>150</td>
                    <td><span class="badge bg-danger">Cancelled</span></td>
                    <td class="action-buttons">
                        <button class="btn btn-dark btn-sm">View PDF</button>
                        <button class="btn btn-warning btn-sm">Download</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
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