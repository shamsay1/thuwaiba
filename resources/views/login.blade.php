<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Academic Login</title>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #eef1f5;
    }

    .login-container {
        width: 380px;
        padding: 35px;
        border-radius: 12px;
        background: #ffffff; /* 🔥 white card */
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    .login-container h2 {
        text-align: center;
        margin-bottom: 10px;
        color: #2c3e50;
    }

    .login-container p {
        text-align: center;
        font-size: 14px;
        color: #7f8c8d;
        margin-bottom: 20px;
    }

    .input-group {
        margin-bottom: 18px;
    }

    .input-group label {
        display: block;
        margin-bottom: 6px;
        font-size: 14px;
        color: #34495e;
    }

    .input-group input {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #dcdfe3;
        outline: none;
        transition: 0.3s;
    }

    .input-group input:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 2px rgba(52,152,219,0.1);
    }

    .login-btn {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 8px;
        background: #2c3e50; /* academic dark */
        color: #fff;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
    }

    .login-btn:hover {
        background: #1a252f;
    }

    .extra {
        margin-top: 15px;
        text-align: center;
        font-size: 13px;
    }

    .extra a {
        color: #3498db;
        text-decoration: none;
    }

    .extra a:hover {
        text-decoration: underline;
    }

</style>
</head>

<body>

<div class="login-container">
    <h2>Academic System</h2>
    <p>Login to your account</p>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="input-group">
            <label>Email Address</label>
            <input type="email" name="email" placeholder="Enter your email" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>
        </div>

        <button type="submit" class="login-btn">Login</button>

        <div class="extra">
            <p>Forgot password? <a href="#">Reset</a></p>
        </div>
    </form>
</div>

</body>
</html>