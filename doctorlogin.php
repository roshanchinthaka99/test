<?php 
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Care Compass Hospital";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctorID = $_POST['doctorID'];
    $password = $_POST['password'];

    // Query to get user details
    $sql = "SELECT doctorID, password, firstname FROM doctordetails WHERE doctorID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $doctorID);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($db_doctorID, $db_password, $firstname);
        $stmt->fetch();

        
        if($password == $db_password) {
            $_SESSION['doctorID'] = $db_doctorID;
            $_SESSION['firstname'] = $firstname; // Store name in session
            echo "<script>alert('Login successful!'); window.location.href='doctordashboard.php';</script>";
        } else {
            echo "<script>alert('Invalid password!'); window.location.href='doctorlogin.php';</script>";
        }
    } else {
        echo "<script>alert('No account found with this doctor ID!'); window.location.href='doctorlogin.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Care Compass Hospital - Doctor Login</title>
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

        .container {
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
            width: 60%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .links {
            margin-top: 15px;
            font-size: 14px;
        }

        .links a {
            font-weight: bold;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .links a:hover {
            color: #0056b3;
        }

        button {
            background-color: #f24a4a;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            float: right;
        }
        button:hover {
            background-color: #f53232;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Doctor Login</h2>
    <form method="post" action="doctorlogin.php"> 
        <label for="doctorID">Doctor ID:</label>
        <input type="text" name="doctorID" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <input type="submit" class="btn" value="Sign In">

        <div class="links">
            <p>Don't have an Account? <a href="doctorregister.php">Sign Up</a></p>
        </div>
    </form>

    <button onclick="window.location.href='staffdoc_login.php';">Cancel</button>

</div>

</body>
</html>