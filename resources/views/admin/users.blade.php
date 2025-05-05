<!-- resources/views/users.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users Management</title>
    <!-- Google Fonts and Bootstrap CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Boldonse&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Basic styling */
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
            font-family: "Boldonse", sans-serif;
            text-decoration: none;
            color: #143D60;
            font-size: 20px;
        }

        .logout {
            margin-left: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            padding: 30px;
        }

        .header h3 {
            font-family: "Boldonse", sans-serif;
            color: #143D60;
        }

        .user-list {
            padding: 20px;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .table th {
            background-color: #e3f2fd;
        }

        .alert {
            position: absolute;
            top: 30%;
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
    <!-- Navigation Bar -->
    <nav class="navbar" style="background-color: #e3f2fd;">
        <div class="title">
            <img src="{{ asset('img/iskolar-logo.png') }}" alt="Logo">
            <a href="#">INB - AMS</a>
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

    <!-- Header with Add User Button -->
    <div class="header">
        <h3>Users Management</h3>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
            Add User
        </button>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Register New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="userName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="userName" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="userEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="userEmail" name="email" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="userPass" class="form-label">Password</label>
                                <input type="password" class="form-control" id="userPass" name="password" required>
                            </div>
                            <div class="col-md-6">
                                <label for="usercPass" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="usercPass" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="userPhone" class="form-label">Phone No.</label>
                                <input type="text" class="form-control" id="userPhone" name="phone" required>
                            </div>
                            <div class="col-md-6">
                                <label for="userRole" class="form-label">Role</label>
                                <select class="form-select" id="userRole" name="role" required>
                                    <option value="Municipal President">Municipal President</option>
                                    <option value="INB Staff">INB Staff</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="userMunicipality" class="form-label">Municipality</label>
                                <select class="form-control" id="userMunicipality" name="municipality" required>
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
                            <div class="col-md-6">
                                <label for="userStatus" class="form-label">Status</label>
                                <select class="form-select" id="userStatus" name="status" required>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        <input type="hidden" id="editUserId" name="id">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="editUserName" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="editUserEmail" name="email" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Phone No.</label>
                                <input type="text" class="form-control" id="editUserPhone" name="phone" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Role</label>
                                <select class="form-select" id="editUserRole" name="role" required>
                                    <option value="Municipal President">Municipal President</option>
                                    <option value="INB Staff">INB Staff</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Municipality</label>
                                <select class="form-select" id="editUserMunicipality" name="municipality" required>
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
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select class="form-select" id="editUserStatus" name="status" required>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="container mb-3" style="width: 350px; margin-right: 20px">
        <input type="text" id="userSearch" class="form-control" placeholder="Search users...">
    </div>

    <!-- User List Table -->
    <div class="user-list mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone No.</th>
                    <th>Role</th>
                    <th>Municipality</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td> <!-- Number starts at 1 and increments -->
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        @if($user->role == 'Municipal President')
                        <span class="badge bg-primary">{{ $user->role }}</span>
                        @else
                        <span class="badge bg-info">{{ $user->role }}</span>
                        @endif
                    </td>
                    <td>{{ $user->municipality }}</td>
                    <td>
                        @if($user->status == 'Active')
                        <span class="badge bg-success">{{ $user->status }}</span>
                        @else
                        <span class="badge bg-secondary">{{ $user->status }}</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm btn-edit-user"
                            data-id="{{ $user->id }}"
                            data-name="{{ $user->name }}"
                            data-email="{{ $user->email }}"
                            data-phone="{{ $user->phone }}"
                            data-role="{{ $user->role }}"
                            data-municipality="{{ $user->municipality }}"
                            data-status="{{ $user->status }}">
                            Edit
                        </button>
                        <button class="btn btn-danger btn-sm btn-delete-user" data-id="{{ $user->id }}">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- ALERT -->
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
        <strong>Success!</strong> User has been added.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!--  -->
    <script>
        // AJAX for Add User Form
        document.getElementById('addUserForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch("{{ route('users.store') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        "Accept": "application/json"
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.text().then(text => {
                            throw new Error(text);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    // Show the Bootstrap alert
                    const alertBox = document.querySelector('.alert');
                    alertBox.style.display = 'block';

                    // Auto-hide after 2.5 seconds (optional)
                    setTimeout(() => {
                        alertBox.classList.remove('show');
                        alertBox.classList.add('hide');
                        // Reload page after the alert is dismissed
                        location.reload();
                    }, 2500);
                })
                .catch(error => {
                    console.error('User registration error:', error);
                    alert('User registration error. Please check your inputs.');
                });
        });

        //Delete User
        document.querySelectorAll('.btn-delete-user').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.dataset.id;

                if (confirm('Are you sure you want to delete this user?')) {
                    fetch(`/users/${userId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Failed to delete user.');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Reload to reflect deleted user
                            location.reload();
                        })
                        .catch(error => {
                            console.error(error);
                            alert('An error occurred while deleting the user.');
                        });
                }
            });
        });

        // Open modal and populate with user data
        document.querySelectorAll('.btn-edit-user').forEach(button => {
            button.addEventListener('click', () => {
                const userId = button.dataset.id;
                document.getElementById('editUserId').value = userId;
                document.getElementById('editUserName').value = button.dataset.name;
                document.getElementById('editUserEmail').value = button.dataset.email;
                document.getElementById('editUserPhone').value = button.dataset.phone;
                document.getElementById('editUserRole').value = button.dataset.role;
                document.getElementById('editUserMunicipality').value = button.dataset.municipality;
                document.getElementById('editUserStatus').value = button.dataset.status;

                new bootstrap.Modal(document.getElementById('editUserModal')).show();
            });
        });

        // Handle edit form submission
        document.getElementById('editUserForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const userId = document.getElementById('editUserId').value;
            const formData = new FormData(this);

            fetch(`/users/${userId}`, {
                    method: 'POST', // Laravel supports PUT via POST + _method
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: new URLSearchParams([...formData, ['_method', 'PUT']]) // simulate PUT method
                })
                .then(response => {
                    if (!response.ok) throw new Error('Update failed');
                    return response.json();
                })
                .then(data => {
                    // Close modal and reload
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editUserModal'));
                    modal.hide();
                    location.reload();
                })
                .catch(error => {
                    console.error('Update Error:', error);
                    alert('An error occurred while updating the user.');
                });
        });
        // Search Bar
        document.getElementById('userSearch').addEventListener('keyup', function() {
            const query = this.value.toLowerCase();
            const rows = document.querySelectorAll('.user-list tbody tr');

            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const text = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    </script>
</body>

</html>