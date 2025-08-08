<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Care Compass Hospital";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the patient is logged in
if (!isset($_SESSION['staffID'])) {
    header("Location: staff_login.php");
    exit();
}


$staffID = $_SESSION['staffID']; // Retrieve staff ID from session
$firstname = $_SESSION['firstname']; // Retrieve staff name from session

// Function to safely fetch count
function fetchCount($conn, $table) {
    $result = $conn->query("SELECT COUNT(*) AS count FROM $table");
    if ($result) {
        return $result->fetch_assoc()['count'];
    } else {
        return 0;
    }
}

// Fetch counts
$doctorCount = fetchCount($conn, "doctordetails");
$patientCount = fetchCount($conn, "patientdetails");
$appointmentCount = fetchCount($conn, "appointments");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Staff Dashboard</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            color: white;
            background: #c8d7e0;
        }
        .title {
            background: #5e2ff8;
            height: 100px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }
        .dashboard {
            display: flex;
            gap: 20px;
            margin: 50px auto;
            justify-content: center;
        }
        .card {
            padding: 20px;
            background: #5e2ff8;
            border-radius: 10px;
            width: 30%;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100px;
        }
        .btn-container {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        .btn a button {
            padding: 10px 15px;
            background: #5e2ff8;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .btn a button:hover {
            background: #3c1eb4;
        }
        .title p{
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="title">
        <h2>Staff Dashboard</h2> 
        <p>Welcome, <?php echo htmlspecialchars($firstname); ?>!</p>
    </div>
    <div class="dashboard">
        <div class="card">
            <h3>Doctors</h3>
            <p>Total: <?php echo $doctorCount; ?></p>
        </div>
        <div class="card">
            <h3>Patients</h3>
            <p>Total: <?php echo $patientCount; ?></p>
        </div>
        <div class="card">
            <h3>Appointments</h3>
            <p>Total: <?php echo $appointmentCount; ?></p>
        </div>
    </div>

    <div class="btn-container">
        <div class="btn">
            <a href="staff_appointment.php">    
                <button>View Appointments</button>
            </a>
        </div>
        <div class="btn">
            <a href="">    
                <button>Lab Report</button>
            </a>
        </div>
        <div class="btn">
            <a href="adminservices.php">    
                <button>Services</button>
            </a>
        </div>
        <div class="btn">
            <a href="#">    
                <button>View Feedback</button>
            </a>
        </div>
        <div class="btn">
            <a href="staff_login.php">    
                <button>Logout</button>
            </a>
        </div>
    </div>
</body>
</html>