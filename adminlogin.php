<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
        }
        .login-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 100%;
            max-width: 350px;
        }
        h2 {
            margin-bottom: 20px;
        }
        input[type="text"], input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        .btn {
            background-color: #f24a4a;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #f53232;
        }
    </style>
</head>
<body>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <input type="text" id="username" placeholder="Username">
        <input type="password" id="password" placeholder="Password">
        <button onclick="login()">Login</button>
        <button class="btn" onclick="window.location.href='loginusers.html';">Cancel</button>
        <p id="error" class="error"></p>
    </div>


    <script>
        function login() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var errorElement = document.getElementById("error");
            
            if (username === "admin" && password === "admin") {
                window.location.href = "admindashboard.php"; // Redirect to dashboard
            } else {
                errorElement.textContent = "Invalid username or password";
            }
        }
    </script>
</body>
</html>

