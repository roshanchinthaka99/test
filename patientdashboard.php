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
if (!isset($_SESSION['patientID'])) {
    header("Location: patientlogin.php");
    exit();
}


$patientID = $_SESSION['patientID']; // Retrieve patient ID from session
$patientName = $_SESSION['firstname']; // Retrieve patient name from session

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: white;
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
        }
        .header {
            background: #5e2ff8;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center; 
            border-radius: 10px 10px 0 0;
            margin: 10px auto;
            font-size: 24px; /* Optional: Increase text size */
            font-weight: bold;
        }
        .container {
            display: flex; 
            gap: 10px; /* Adds spacing between buttons */
            justify-content: center; /* Centers buttons in the row */
            margin-top: 20px;
        }
        button {
            background: #5e2ff8;
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        button:hover{
            background: #3c1eb4;
        }
    </style>
</head>
<body>

<div class="header">
Welcome, <?php echo htmlspecialchars($patientName); ?>! 
</div>
<div class="container">
       <button onclick="window.location.href='bookappointment.php';">Book Appointment</button>
       <button onclick="window.location.href='patientservices.php';">Services</button>
       <button onclick="window.location.href='validdocs.php';">Valid Doctors</button>
       <button onclick="window.location.href='labreport.php';">Lab Reports</button>
       <button onclick="window.location.href='payment.php';">Payment</button>
       <button onclick="window.location.href='query.php';">Query</button>
       <button onclick="window.location.href='patientlogin.php';">Logout</button>        
</div>

</body>
</html>
