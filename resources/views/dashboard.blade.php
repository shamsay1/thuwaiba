@extends('layout.app')

@section('content')
<div class="main">

    <div class="navbar">
    <h3>Dashboard</h3>

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
     <div class="container-fluid mt-4">

    @if(Auth::user()->role=="admin")

    <div class="row g-4">

        <!-- Total Teachers -->
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-lg rounded-4 h-100">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <h6 class="text-muted mb-2">Total Teachers</h6>
                        <h2 class="fw-bold text-primary">
                            {{ $total_teachers }}
                        </h2>
                    </div>

                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-person-fill fs-2 text-primary"></i>
                    </div>

                </div>
            </div>
        </div>

        <!-- Total HOD -->
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-lg rounded-4 h-100">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <h6 class="text-muted mb-2">Total HOD</h6>
                        <h2 class="fw-bold text-success">
                            {{ $total_hod }}
                        </h2>
                    </div>

                    <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-person-badge-fill fs-2 text-success"></i>
                    </div>

                </div>
            </div>
        </div>

        <!-- Total Equipment -->
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-lg rounded-4 h-100">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <h6 class="text-muted mb-2">Total Equipment</h6>
                        <h2 class="fw-bold text-warning">
                            {{ $total_equipment->count() }}
                        </h2>
                    </div>

                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-pc-display fs-2 text-warning"></i>
                    </div>

                </div>
            </div>
        </div>

        <!-- Total Request -->
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-lg rounded-4 h-100">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <h6 class="text-muted mb-2">Total Request</h6>
                        <h2 class="fw-bold text-danger">
                            {{ $total_request->count() }}
                        </h2>
                    </div>

                    <div class="bg-danger bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-envelope-paper-fill fs-2 text-danger"></i>
                    </div>

                </div>
            </div>
        </div>

    </div>

    @elseif(Auth::user()->role=="hod")

    <div class="row g-4">

        <!-- Total Teachers -->
        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-lg rounded-4 h-100">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <h6 class="text-muted mb-2">Total Teachers</h6>
                        <h2 class="fw-bold text-primary">
                            {{ $teachers->count() }}
                        </h2>
                    </div>

                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-person-fill fs-2 text-primary"></i>
                    </div>

                </div>
            </div>
        </div>

        <!-- Total Equipment -->
        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-lg rounded-4 h-100">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <h6 class="text-muted mb-2">Total Equipment</h6>
                        <h2 class="fw-bold text-warning">
                            {{ $total_equipment->where('department_id',Auth::user()->department_id)->count() }}
                        </h2>
                    </div>

                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-pc-display fs-2 text-warning"></i>
                    </div>

                </div>
            </div>
        </div>

        <!-- Total Request -->
        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-lg rounded-4 h-100">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <h6 class="text-muted mb-2">Total Request</h6>
                        <h2 class="fw-bold text-danger">
                            {{ $total_request->where('department_id',Auth::user()->department_id)->count() }}
                        </h2>
                    </div>

                    <div class="bg-danger bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-envelope-paper-fill fs-2 text-danger"></i>
                    </div>

                </div>
            </div>
        </div>

    </div>

    @endif

</div>

       <div class="table-container-wrapper">

    <!-- LEFT SIDE : BIG GRAPH -->
    <div class="graph-box">

        <div class="box-header">
            <h3>Device Statistics</h3>
        </div>

        <div class="chart-container">

            @php
                $max = $deviceStats->max('quantity_available') ?: 1;
            @endphp

            @foreach($deviceStats as $device)

            <div class="chart-item">

                <span>{{ $device->equipment_name }}</span>

                <div class="bar">
                    <div class="fill"
                         style="width: {{ ($device->quantity_available / $max) * 100 }}%;">

                         {{ $device->quantity_available }}

                    </div>
                </div>

            </div>

            @endforeach

        </div>

    </div>


    <!-- RIGHT SIDE : SMALL TABLE -->
    <div class="users-box">

        <div class="box-header">
            <h3>Recent Users</h3>
        </div>

        <table>

            <tr>
                <th>Teachers Name</th>
                <th>Status</th>
            </tr>
            @forelse ($teachers as $teacher)
            <tr>
                <td>{{ $teacher->firstname }} {{ $teacher->middlename }} {{ $teacher->lastname }}</td>
                <td><span class="{{ strtolower($teacher->status) }}">
                {{ $teacher->status }}
            </span>
            </td>
            </tr>
                
            @empty
                
            @endforelse


            

        </table>
        <div style="text-align: center;margin-top: 4px">
        <a href="" style="text-decoration: none">Viewl all</a>
        </div>

    </div>

</div>



<style>

.table-container-wrapper{
    display: flex;
    gap: 20px;
    width: 100%;
    margin-top: 20px;
    align-items: flex-start;
}

/* BIG GRAPH */
.graph-box{
    flex: 3;
    background: #fff;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
}

/* SMALL TABLE */
.users-box{
    flex: 1;
    background: #fff;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
}

/* HEADER */
.box-header{
    margin-bottom: 20px;
}

.box-header h3{
    font-size: 20px;
    color: #333;
}

/* GRAPH */
.chart-container{
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.chart-item span{
    font-size: 14px;
    font-weight: 600;
    color: #444;
}

.bar{
    width: 100%;
    height: 24px;
    background: #eee;
    border-radius: 30px;
    overflow: hidden;
    margin-top: 6px;
}

.fill{
    height: 100%;
    background: linear-gradient(90deg,#4f46e5,#06b6d4);
    border-radius: 30px;
    color: white;
    font-size: 12px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding-right: 10px;
    font-weight: bold;
}

/* TABLE */
table{
    width: 100%;
    border-collapse: collapse;
}

table th{
    background: #f5f5f5;
    padding: 12px;
    text-align: left;
    font-size: 14px;
}

table td{
    padding: 12px;
    border-bottom: 1px solid #eee;
    font-size: 14px;
}

/* STATUS */
.active{
    background: #dcfce7;
    color: #166534;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
}

.inactive{
    background: #fee2e2;
    color: #991b1b;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
}

/* RESPONSIVE */
@media(max-width: 768px){

    .table-container-wrapper{
        flex-direction: column;
    }

    .graph-box,
    .users-box{
        width: 100%;
    }

}

</style>

    </div>

</div>

@endsection