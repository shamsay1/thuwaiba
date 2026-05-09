@extends('layout.app')


@section('content')

<div class="main">

    <div class="navbar">
        <h3>Equipment</h3>

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

            <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addEquipmentModal">
                Add Equipment
            </button>

            <h3 style="margin:10px 0;">All Equipment</h3>

            <table class="table table-striped table-bordered table-sm">

                <tr>
                    <th>#</th>
                    <th>Equipment Name</th>
                    <th>Quantity</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>

                @forelse ($equipments as $equipment)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $equipment->equipment_name }}</td>
                    <td>{{ $equipment->quantity_available }}</td>
                    <td>{{ $equipment->department->department_name ?? 'N/A' }}</td>

                    <td>
                        <button class="btn btn-success btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editEquipmentModal{{ $equipment->id }}">
                            Edit
                        </button>
                    </td>
                </tr>

                <!-- EDIT MODAL -->
                <div class="modal fade" id="editEquipmentModal{{ $equipment->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Edit Equipment</h5>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form method="POST" action="{{ route('equipment.update', $equipment->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="modal-body">

                                    <div class="mb-2">
                                        <label>Equipment Name</label>
                                        <input type="text" name="equipment_name"
                                            class="form-control"
                                            value="{{ $equipment->equipment_name }}"
                                            required>
                                    </div>

                                    <div class="mb-2">
                                        <label>Quantity</label>
                                        <input type="number" name="quantity_available"
                                            class="form-control"
                                            value="{{ $equipment->quantity_available }}"
                                            required>
                                    </div>

                                    <div class="mb-2">
                                        <label>Department</label>
                                        <select name="department_id" class="form-control" required>

                                            @foreach ($departments as $dept)
                                                <option value="{{ $dept->id }}"
                                                    {{ $equipment->department_id == $dept->id ? 'selected' : '' }}>
                                                    {{ $dept->department_name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-success">Update</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

                @empty
                <tr>
                    <td colspan="5" class="text-center">No records found</td>
                </tr>
                @endforelse

            </table>

        </div>

    </div>
</div>

<!-- ADD MODAL -->
<div class="modal fade" id="addEquipmentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Equipment</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('equipment.store') }}">
                @csrf

                <div class="modal-body">

                    <div class="mb-2">
                        <label>Equipment Name</label>
                        <input type="text" name="equipment_name" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Quantity</label>
                        <input type="number" name="quantity_available" class="form-control" required>
                    </div>

                    {{-- <div class="mb-2">
                        <label>Department</label>
                        <select name="department_id" class="form-control" required>

                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}">
                                    {{ $dept->department_name }}
                                </option>
                            @endforeach

                        </select>
                    </div> --}}

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save</button>
                </div>

            </form>

        </div>
    </div>
</div>


@endsection