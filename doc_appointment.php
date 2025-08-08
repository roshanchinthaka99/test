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
$firstName = $_SESSION['firstname']; 

// Handle appointment booking
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctorID = $_POST['doctorID'];
    $qualification =$_POST['qualification'];
    $contact =$_POST['contact'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Insert appointment details into the database
    $sql = "INSERT INTO appointments (patientID, doctorID, qualification, contact, date, time) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssssss", $patientID, $doctorID, $qualification, $contact, $date, $time);

    if ($stmt->execute()) {
        echo "<script>alert('Appointment booked successfully!'); window.location.href='patientdashboard.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='patientdashboard.php';</script>";
    }

    $stmt->close();
}

// Retrieve booked appointments for the logged-in patient
$sql = "SELECT * FROM appointments WHERE doctorID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $doctorID);
$stmt->execute();
$result = $stmt->get_result();

$conn->close();
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
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
        }
        .header {
            background: #160fef;
            color: white;
            padding: 15px;
            font-size: 15px;
            text-align: center;
        }
        .container {
            text-align: center;
            padding: 30px;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
            box-shadow: 0px 0px 10px gray;
            margin-bottom: 20px;
        }
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        .back {
            float: right;
        }
        .back a {
            text-decoration: none;
            background: #128401;
            color: white;
            padding: 5px 15px;
            border-radius: 5px;
        }
        .back a:hover {
            background: #0f6e00;
        }
        button {
            background: #128401;
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        .button :hover {
            background: #0f6e00;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>
        Book Appointment
    </h1>

    <div class="back">
        <a href=" patientdashboard.php">Back</a>
    </div>
</div>


<div class="container">
    

    <h2>Your Booked Appointments</h2>
    <table>
        <tr>
            <th>Appointment ID</th>
            <th>Doctor ID</th>
            <th>Patient ID</th>            
            <th>Date</th>
            <th>Patient Contact</th>
            <th>Time</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['doctorID'] ?></td>
            <td><?= $row['patientID'] ?></td>
            <td><?= $row['date'] ?></td>
            <td><?= $row['contact'] ?></td>
            <td><?= $row['time'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    
</div>

</body>
</html>
