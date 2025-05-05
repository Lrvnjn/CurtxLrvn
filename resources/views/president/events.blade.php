<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Activities Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Boldonse&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .header h3 {
            font-family: "Boldonse", system-ui;
            color: #143D60;
        }

        .header {
            display: flex;
            justify-content: space-between;
            padding: 30px;
        }

        .header button {
            height: 50px;
        }

        .activity-list {
            padding: 20px;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .table th {
            background-color: #e3f2fd;
        }

        .action-buttons .btn {
            margin: 0 5px;
        }
    </style>
</head>

<body>
    <nav class="navbar sticky-top" style="background-color: #e3f2fd;">
        <div class="title">
            <img src="{{ asset('img/iskolar-logo.png') }}" alt="INB LOGO">
            <a href="#">INB - AMS</a>
        </div>
        <div class="pages">
            <a href="{{ route('president.dashboard') }}">Dashboard</a>
            <a href="{{ route('events') }}">Activities</a>
            <a href="{{ route('generate') }}">Generate</a>
            <a href="{{ route('overview') }}">Overview</a>  
        </div>
        <div class="logout me-4">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-dark">LOG OUT</button>
            </form>
        </div>
    </nav>

    <div class="header">
        <h3>Activities Management</h3>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createActivityModal">
            Create Activity
        </button>
    </div>

    <!-- Activity List -->
    <div class="activity-list">
        <table class="table table-bordered" id="activityTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Activity Name</th>
                    <th>Provincial/Municipal</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp

                @foreach ($activities as $activity)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $activity->activity_name }}</td>
                    <td>{{ $activity->location }}</td>
                    <td>{{ $activity->date }}</td>
                    <td class="status-cell">
                        <span class="badge 
                            {{ $activity->status == 0 ? 'bg-warning' : ($activity->status == 1 ? 'bg-success' : 'bg-danger') }}">
                            {{ $activity->status == 0 ? 'Pending' : ($activity->status == 1 ? 'Approved' : 'Rejected') }}
                        </span>
                    </td>
                    <td class="action-buttons">
                        @if ($activity->status == 1)
                        <a href="{{ route('events.manage', $activity->id) }}" class="btn btn-dark btn-sm">Manage</a>
                        @endif
                        <button class="btn btn-primary btn-sm edit-btn">Edit</button>
                        <button class="btn btn-danger btn-sm delete-btn">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Create Activity Modal -->
    <div class="modal fade" id="createActivityModal" tabindex="-1" aria-labelledby="createActivityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="createActivityForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createActivityModalLabel">Create New Activity</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="activity_name" class="form-label">Activity Name</label>
                            <input type="text" class="form-control" id="activity_name" name="activity_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Municipal</label>
                            <input type="text" class="form-control" id="location" name="location" value="Bataan" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Municipal</label>
                            <select class="form-select" id="location" name="location">
                                <option value="" disabled selected>Select Municipality</option>
                                <option value="Abucay">Abucay</option>
                                <option value="Bagac">Bagac</option>
                                <option value="City of Balanga">City of Balanga</option>
                                <option value="Dinalupihan">Dinalupihan</option>
                                <option value="Hermosa">Hermosa</option>
                                <option value="Limay">Limay</option>
                                <option value="Mariveles">Mariveles</option>
                                <option value="Morong">Morong</option>
                                <option value="Orani">Orani</option>
                                <option value="Orion">Orion</option>
                                <option value="Pilar">Pilar</option>
                                <option value="Samal">Samal</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Create Activity</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Activity Modal -->
    <div class="modal fade" id="editActivityModal" tabindex="-1" aria-labelledby="editActivityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="editActivityForm">
                    @csrf
                    <input type="hidden" id="edit_activity_id" name="activity_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editActivityModalLabel">Edit Activity</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_activity_name" class="form-label">Activity Name</label>
                            <input type="text" class="form-control" id="edit_activity_name" name="activity_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_location" class="form-label">Provincial</label>
                            <input type="text" class="form-control" id="edit_location" name="location" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="edit_date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="edit_date" name="date" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Activity</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Alert -->
    <div class="alert alert-success alert-dismissible fade show" id="activityAlert" role="alert" style="display: none; position: absolute; top: 30%; right: 13%; transform: translate(50%, 50%); z-index: 9999;">
        <strong>Success!</strong> Activity has been added.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // CREATE ACTIVITY
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("createActivityForm");

            form.addEventListener("submit", function(e) {
                e.preventDefault();

                const formData = new FormData(form);

                fetch("/events/store", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success && data.activity) {
                            const activity = data.activity;

                            const tbody = document.querySelector("#activityTable tbody");
                            const newRow = document.createElement('tr');
                            newRow.innerHTML = `
                    <td>${activity.id}</td>
                    <td>${activity.activity_name}</td>
                    <td>${activity.location}</td>
                    <td>${activity.date}</td>
                    <td class="status-cell">
                        <span class="badge 
                            ${activity.status == 0 ? 'bg-warning' : 
                            activity.status == 1 ? 'bg-success' : 
                            'bg-danger'}">
                            ${activity.status == 0 ? 'Pending' : 
                            activity.status == 1 ? 'Approved' : 
                            'Rejected'}
                        </span>
                    </td>
                    <td class="action-buttons">
                        ${Number(activity.status) === 1 ? `<a href="/activities/manage/${activity.id}" class="btn btn-dark btn-sm">Manage</a>` : ''}
                        <button class="btn btn-primary btn-sm edit-btn">Edit</button>
                        <button class="btn btn-danger btn-sm delete-btn">Delete</button>
                    </td>
                `;

                            tbody.appendChild(newRow);

                            // Close modal and reset form
                            bootstrap.Modal.getInstance(document.getElementById('createActivityModal')).hide();
                            form.reset();

                            // Show success alert
                            const alertBox = document.getElementById("activityAlert");
                            alertBox.querySelector("strong").textContent = "Success!";
                            alertBox.style.display = "block";
                            alertBox.classList.add("show");
                            setTimeout(() => {
                                alertBox.classList.remove("show");
                                alertBox.classList.add("hide");
                            }, 2500);
                        } else {
                            alert("Failed to create activity.");
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert("Error occurred while creating activity.");
                    });
            });
        });


        // OPEN EDIT MODAL AND POPULATE FIELDS
        document.querySelector("#activityTable").addEventListener("click", function(event) {
            if (event.target.classList.contains("btn-primary")) {
                const row = event.target.closest("tr");

                const id = row.children[0].textContent;
                const name = row.children[1].textContent;
                const location = row.children[2].textContent;
                const date = row.children[3].textContent;

                document.getElementById("edit_activity_id").value = id;
                document.getElementById("edit_activity_name").value = name;
                document.getElementById("edit_location").value = location;
                document.getElementById("edit_date").value = date;

                const editModal = new bootstrap.Modal(document.getElementById("editActivityModal"));
                editModal.show();
            }
        });

        // EDIT ACITIVITY
        document.getElementById("editActivityForm").addEventListener("submit", function(e) {
            e.preventDefault();

            const id = document.getElementById("edit_activity_id").value;
            const formData = new FormData(this);
            formData.append('_method', 'PUT');

            fetch(`/activities/${id}`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) throw new Error("Failed to update activity.");
                    return response.json();
                })
                .then(data => {
                    const rows = document.querySelectorAll("#activityTable tbody tr");
                    rows.forEach(row => {
                        if (row.children[0].textContent == id) {
                            row.children[1].textContent = data.activity.activity_name;
                            row.children[2].textContent = data.activity.location;
                            row.children[3].textContent = data.activity.date;
                        }
                    });

                    const editModal = bootstrap.Modal.getInstance(document.getElementById("editActivityModal"));
                    editModal.hide();

                    alert("Activity updated successfully.");
                })
                .catch(error => {
                    console.error("Update error:", error);
                    alert("An error occurred while updating the activity.");
                });
        });

        // ALERT
        const alertBox = document.getElementById("activityAlert");
        alertBox.style.display = 'block';
        setTimeout(() => {
            alertBox.classList.remove('show');
            alertBox.classList.add('hide');
        }, 2500);
    </script>
</body>

</html>