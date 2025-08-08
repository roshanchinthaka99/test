<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Care Compass Hospital";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to safely fetch count
function fetchCount($conn, $table) {
    $result = $conn->query("SELECT COUNT(*) AS count FROM $table");
    if ($result) {
        return $result->fetch_assoc()['count'];
    } else {
        return 0; // Return 0 or handle the error as needed
    }
}

// Fetch counts
$doctorCount = fetchCount($conn, "doctordetails");
$patientCount = fetchCount($conn, "patientdetails");
$appointmentCount = fetchCount($conn, "appointments");
$staffCount = fetchCount($conn, "staffdetails");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }
        .title {
    width: 90%;
    max-width: 1200px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 15px 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.2);
    margin-top: 20px;
}
        .banner {
            width: 100%;
            height: 100vh;
            background: linear-gradient(to bottom, #1e3c72, #2a5298);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .dashboard {
            display: flex;
            gap: 20px;
            margin-top: 50px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .logo {
    width: 100px;
    height: auto;
    border-radius: 10px;
    transition: transform 0.3s ease-in-out;
}

.logo:hover {
    transform: scale(1.1);
}

/* Welcome Message */
.title h1 {
    font-size: 24px;
    font-weight: bold;
    text-transform: uppercase;
    color: white;
    text-align: center;
    flex-grow: 1;
}

/* Home/Login Button */
.home-btn {
    width: 120px;
    padding: 10px;
    border-radius: 25px;
    font-weight: bold;
    border: 2px solid white;
    background: transparent;
    color: white;
    cursor: pointer;
    transition: 0.3s;
}

.home-btn:hover {
    background: white;
    color: #1e3c72;
}
        .card {
            padding: 20px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            width: 180px;
            height: 120px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.3);
        }

        .card a {
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            color: white;
            text-transform: uppercase;
            transition: 0.3s;
        }

        .card:hover {
            background: rgba(255, 255, 255, 0.4);
            transform: scale(1.05);
        }

        .card a:hover {
            color: #1e3c72;
        }
        @media (max-width: 768px) {
        .title {
            flex-direction: column;
            text-align: center;
        }
        .dashboard {
            flex-direction: column;
            align-items: center;
        }
        }
    </style>
</head>
<body>
    <div class="banner">
    <div class="title">
            <img src="images\hospitallogo.jpeg" alt="Hospital Logo" class="logo">
            <h1>Staff Dashboard</h1>
            <button class="home-btn" onclick="window.location.href='loginusers.html';">BACK</button>
        </div>
    <div class="dashboard">
    <div class="card">
                <a href="doctorlogin.php">DOCTORS</a>
            </div>
    <div class="card">
        <a href="staff_login.php">STAFF</a>
    </div>
    </div>
</div>
</body>
</html>