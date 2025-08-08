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
if (!isset($_SESSION['doctorID'])) {
    header("Location: doctorlogin.php");
    exit();
}


$doctorID = $_SESSION['doctorID'];
$firstname = $_SESSION['firstname'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
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
Welcome, <?php echo htmlspecialchars($firstname); ?>! 
</div>


<div class="container">
       <button onclick="window.location.href='docshedule.php';">Change Schedule</button>
       <button onclick="window.location.href='docchangename.php';">Change Name</button>
       <button onclick="window.location.href='doc_appointment.php';">Appointments</button>
       <button onclick="window.location.href='doctorlogin.php';">Logout</button>
</div>

</body>
</html>
