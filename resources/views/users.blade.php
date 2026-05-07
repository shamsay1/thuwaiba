@extends('layout.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@section('content')

<div class="main">

    <div class="navbar">
        <h3>Dashboard</h3>

        <div class="user">

            <!-- ADD USER BUTTON -->
            

            <!-- LOGOUT -->
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>

        </div>
    </div>

    <div class="content">

        <div class="table-container">
            <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="bi bi-person-plus"></i> Add User
            </button>
            <h3 style="margin: 10">All users informations</h3>

            
            <table class="table table-striped table-sm">
    <tr>
        <th>First Name</th>
        <th>Middle Name</th>
        <th>Last Name</th>
        <th>Phone number</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Role</th>
        <th>Action</th>
    </tr>

    @forelse ($users as $user)

    <tr>
        <td>{{ $user->firstname }}</td>
        <td>{{ $user->middlename }}</td>
        <td>{{ $user->lastname }}</td>
        <td>{{ $user->mobile }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->gender }}</td>
        <td>{{ $user->role }}</td>

        <td>
            <!-- EDIT BUTTON -->
            <button class="btn btn-success btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#editUserModal{{ $user->id }}">
                Edit
            </button>
        </td>
    </tr>

    <!-- EDIT MODAL -->
    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>
                </div>

                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label>First Name</label>
                                <input type="text"
                                    name="firstname"
                                    class="form-control"
                                    value="{{ $user->firstname }}"
                                    required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Middle Name</label>
                                <input type="text"
                                    name="middlename"
                                    class="form-control"
                                    value="{{ $user->middlename }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Last Name</label>
                                <input type="text"
                                    name="lastname"
                                    class="form-control"
                                    value="{{ $user->lastname }}"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Gender</label>

                                <select name="gender" class="form-control" required>
                                    <option value="Male"
                                        {{ $user->gender == 'Male' ? 'selected' : '' }}>
                                        Male
                                    </option>

                                    <option value="Female"
                                        {{ $user->gender == 'Female' ? 'selected' : '' }}>
                                        Female
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Email</label>

                                <input type="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ $user->email }}"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Mobile</label>

                                <input type="text"
                                    name="mobile"
                                    class="form-control"
                                    value="{{ $user->mobile }}"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Role</label>

                                <select name="role" class="form-control" required>

                                    <option value="hod"
                                        {{ $user->role == 'hod' ? 'selected' : '' }}>
                                        HOD
                                    </option>

                                    <option value="teacher"
                                        {{ $user->role == 'teacher' ? 'selected' : '' }}>
                                        Teacher
                                    </option>
                                    <option value="principle"
                                        {{ $user->role == 'principle' ? 'selected' : '' }}>
                                        Principle
                                    </option>

                                </select>
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                            Close
                        </button>

                        <button type="submit"
                            class="btn btn-success">
                            Update
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

    @empty

    <tr>
        <td colspan="100" style="text-align:center">
            No records found
        </td>
    </tr>

    @endforelse

</table>

        </div>

    </div>
</div>

<!-- ================= MODAL ================= -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="">
                @csrf

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label>First Name</label>
                            <input type="text" name="firstname" class="form-control" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Middle Name</label>
                            <input type="text" name="middlename" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Last Name</label>
                            <input type="text" name="lastname" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Gender</label>
                            <select name="gender" class="form-control" required>
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Mobile</label>
                            <input type="text" name="mobile" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Role</label>
                            <select name="role" class="form-control" required>
                                <option value="">Select</option>
                            @if (Auth::user()->role=="admin")

                                <option value="principle">Principle</option>
                                <option value="hod">Head of department</option>
                                <option value="teacher">Teacher</option>
                            @else
                                <option value="teacher">Teacher</option>
                            @endif
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Departments</label>
                            <select name="department" class="form-control" required>
                                <option value="">--Select department--</option>
                                @foreach ($departmnets as $d)
                                <option value="{{ $d->id }}">{{$d->department_name}}</option>
                                    
                                @endforeach
                            </select>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>

            </form>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection