



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Academic Dashboard</title>

<!-- ✅ Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

/* BODY */
body {
    display: flex;
    background: #f4f6f9;
}

/* SIDEBAR */
.sidebar {
    width: 180px;
    height: 100vh;
    background: linear-gradient(180deg, #1e3c72, #2a5298);
    color: #fff;
    position: fixed;
    padding-top: 20px;
}

/* PROFILE */
.profile {
    text-align: center;
    margin-bottom: 20px;
}

.profile img {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    border: 3px solid rgba(255,255,255,0.3);
    margin-bottom: 10px;
}

.profile h4 {
    font-size: 14px;
}

.profile p {
    font-size: 12px;
    opacity: 0.8;
}

/* MENU */
.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    position: relative;
    padding: 12px 15px;
    margin: 5px 10px;
    border-radius: 8px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: 0.3s;
}

/* ICON */
.sidebar ul li i {
    font-size: 18px;
}

/* HOVER */
.sidebar ul li:hover {
    background: rgba(255,255,255,0.15);
}

/* ACTIVE */
.sidebar ul li.active {
    background: rgba(255,255,255,0.2);
}

/* LEFT LINE */
.sidebar ul li.active::before {
    content: '';
    position: absolute;
    left: 0;
    top: 8px;
    height: 70%;
    width: 4px;
    background: #00d4ff;
    border-radius: 5px;
}

/* MAIN */
.main {
    margin-left: 180px;
    width: calc(100% - 180px);
}

/* NAVBAR */
.navbar {
    background: #fff;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.navbar h3 {
    color: #2c3e50;
}

.navbar .user {
    color: #555;
}

/* CONTENT */
.content {
    padding: 20px;
}

/* CARDS */
.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.card {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-5px);
}

.card h4 {
    color: #7f8c8d;
}

.card h2 {
    margin-top: 10px;
    color: #2c3e50;
}

/* TABLE */
.table-container {
    margin-top: 30px;
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th, table td {
    padding: 12px;
    border-bottom: 1px solid #eee;
}

/* RESPONSIVE */
@media(max-width: 768px){
    .sidebar {
        display: none;
    }

    .main {
        margin-left: 0;
        width: 100%;
    }
}
/* make form inline so it behaves like button */
.logout-form {
    margin: 0;
    padding: 0;
}

/* logout button styled like navbar button */
.logout-btn {
    border: none;
    outline: none;
    background: #e74c3c;
    color: #fff;
    padding: 7px 12px;
    border-radius: 6px;
    font-size: 13px;
    cursor: pointer;

    display: flex;
    align-items: center;
    gap: 6px;

    transition: 0.3s;
}

/* hover effect */
.logout-btn:hover {
    background: #c0392b;
    transform: translateY(-1px);
}
li a{
    color: white;
    text-decoration: none;
}
/* remove button default focus ugly border */
.logout-btn:focus {
    outline: none;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="profile">
        <img src="https://i.pravatar.cc/100">
        <h4>Admin</h4>
        <p>Academic System</p>
    </div>

    <ul>
        <li class="active"><i class="bi bi-speedometer2"></i> <a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li><i class="bi bi-people"></i> <a href="{{ route('users.index') }}">Users</a></li>
        <li><i class="bi bi-book"></i> Courses</li>
        <li><i class="bi bi-person-badge"></i> Teachers</li>
        <li><i class="bi bi-bar-chart"></i> Attendance</li>
        <li><i class="bi bi-graph-up"></i> Reports</li>
        <li><i class="bi bi-gear"></i> Settings</li>
    </ul>
</div>

<!-- MAIN -->
@yield('content')

</body>
</html>