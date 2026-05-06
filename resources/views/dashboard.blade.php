@extends('layout.app')
@section('content')
<div class="main">

    <div class="navbar">
    <h3>Dashboard</h3>

    <div class="user">
        <form method="POST" action="" class="logout-form">
    @csrf
    <button type="submit" class="logout-btn">
        <i class="bi bi-box-arrow-right"></i> Logout
    </button>
</form>
    </div>
</div>

    <div class="content">

        <div class="cards">
            <div class="card">
                <h4>Total Students</h4>
                <h2>120</h2>
            </div>

            <div class="card">
                <h4>Total Teachers</h4>
                <h2>15</h2>
            </div>

            <div class="card">
                <h4>Courses</h4>
                <h2>8</h2>
            </div>

            <div class="card">
                <h4>Attendance</h4>
                <h2>85%</h2>
            </div>
        </div>

        <div class="table-container">
            <h3>Recent Students</h3>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td>John Doe</td>
                    <td>ICT</td>
                    <td>Active</td>
                </tr>
                <tr>
                    <td>Mary Jane</td>
                    <td>Business</td>
                    <td>Active</td>
                </tr>
                <tr>
                    <td>Ali Hassan</td>
                    <td>Engineering</td>
                    <td>Inactive</td>
                </tr>
            </table>
        </div>

    </div>

</div>

@endsection