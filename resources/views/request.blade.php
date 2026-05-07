@extends('layout.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')

<div class="main">

    <div class="navbar">
        <h3>Equipment Requests</h3>

        <div class="user">
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="btn btn-dark">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <div class="content">

        <div class="table-container">
        @if (Auth::user()->role!="admin")
           
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRequestModal">
                New Request
            </button>
        @endif

            <h3 style="margin:10px 0;">All Requests</h3>

            <table class="table table-striped table-bordered table-sm">

                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Department</th>
                    <th>Equipment</th>
                    <th>Quantity</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>

                @forelse ($requests as $req)

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $req->user->firstname ?? '' }}</td>

                    <td>{{ $req->department->department_name ?? '' }}</td>

                    <td>{{ $req->equipment->equipment_name ?? '' }}</td>

                    <td>{{ $req->quantity }}</td>

                    <td>{{ $req->reason }}</td>

                    <td>
                        <span class="badge bg-warning">
                            {{ $req->overall_status }}
                        </span>
                    </td>

                    <td>{{ $req->request_date }}</td>

                    <td>
                        <button class="btn btn-success btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $req->id }}">
                            Edit
                        </button>
                    </td>
                </tr>

                <!-- EDIT MODAL -->
                <div class="modal fade" id="editModal{{ $req->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5>Edit Request</h5>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form method="POST" action="{{ route('requests.update', $req->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="modal-body">

                                    <div class="mb-2">
                                        <label>Quantity</label>
                                        <input type="number"
                                            name="quantity"
                                            class="form-control"
                                            value="{{ $req->quantity }}">
                                    </div>

                                    <div class="mb-2">
                                        <label>Reason</label>
                                        <textarea name="reason" class="form-control">{{ $req->reason }}</textarea>
                                    </div>

                                    <div class="mb-2">
                                        <label>Status</label>
                                        <select name="overall_status" class="form-control">
                                            <option value="pending_hod" {{ $req->overall_status == 'pending_hod' ? 'selected' : '' }}>Pending HOD</option>
                                            <option value="approved" {{ $req->overall_status == 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected" {{ $req->overall_status == 'rejected' ? 'selected' : '' }}>Rejected</option>
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
                    <td colspan="9" class="text-center">No requests found</td>
                </tr>
                @endforelse

            </table>

        </div>

    </div>
</div>

<!-- ADD MODAL -->
<div class="modal fade" id="addRequestModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5>New Request</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('requests.store') }}">
                @csrf

                <div class="modal-body">

                    {{-- <div class="mb-2">
                        <label>Department</label>
                        <select name="department_id" class="form-control">
                            @foreach($departments as $d)
                                <option value="{{ $d->id }}">{{ $d->department_name }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="mb-2">
                        <label>Equipment</label>
                        <select name="equipment_id" class="form-control">
                            @foreach($equipments as $e)
                                <option value="{{ $e->id }}">{{ $e->equipment_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2">
                        <label>Quantity</label>
                        <input type="number" name="quantity" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label>Reason</label>
                        <textarea name="reason" class="form-control"></textarea>
                    </div>

                    <div class="mb-2">
                        <label>Request Date</label>
                        <input type="date" name="request_date" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Submit</button>
                </div>

            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection