@extends('layout.app')


@section('content')

<div class="main">

    <div class="navbar">
        <h3>Departments</h3>

        <div class="user">

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
              <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">
                <i class="bi bi-plus-circle"></i> Add Department
            </button>
            <h3 style="margin:10px 0;">All Departments</h3>

            <table class="table table-striped table-bordered table-sm">
                <tr>
                    <th>#</th>
                    <th>Department Name</th>
                    <th>Action</th>
                </tr>

                @forelse ($departments as $department)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $department->department_name }}</td>

                    <td>
                        <!-- EDIT BUTTON -->
                        <button class="btn btn-success btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editDepartmentModal{{ $department->id }}">
                            Edit
                        </button>
                    </td>
                </tr>

                <!-- EDIT MODAL -->
                <div class="modal fade" id="editDepartmentModal{{ $department->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Edit Department</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form method="POST" action="{{ route('departments.update', $department->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label>Department Name</label>
                                        <input type="text"
                                            name="department_name"
                                            class="form-control"
                                            value="{{ $department->department_name }}"
                                            required>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>

                                    <button type="submit" class="btn btn-success">
                                        Update
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

                @empty

                <tr>
                    <td colspan="3" class="text-center">No records found</td>
                </tr>

                @endforelse

            </table>

        </div>

    </div>
</div>

<!-- ADD MODAL -->
<div class="modal fade" id="addDepartmentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('departments.store') }}">
                @csrf

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Department Name</label>
                        <input type="text"
                            name="department_name"
                            class="form-control"
                            required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Close
                    </button>

                    <button type="submit"
                        class="btn btn-primary">
                        Save
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


@endsection