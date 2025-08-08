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
            background: #c8d7e0;
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
        .back {
            width: 120px;
            padding: 10px;
            border-radius: 25px;
            font-weight: bold;
            border: 2px solid white;
            background: transparent;
            color: white;
            background:rgb(78, 72, 255);
            cursor: pointer;
            transition: 0.3s;
        }

        .back:hover {
            background:rgb(84, 73, 239);
            color: #1e3c72;
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
    </style>
</head>
<body>
    <div class="header">
        <h1>Book Appointments</h1>
    </div>
    <div class="container">
        <table>
        <tr>
            <th>Appointment ID</th>
            <th>Patient ID</th>
            <th>Doctor ID</th>
            <th>Date</th>
            <th>Patient Contact</th>
            <th>Time</th>
        </tr>

        <?php
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM appointments";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) 
            
         while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['patientID'] ?></td>
            <td><?= $row['doctorID'] ?></td>
            <td><?= $row['date'] ?></td>
            <td><?= $row['contact'] ?></td>
            <td><?= $row['time'] ?></td>
        </tr>
        <?php endwhile; ?>
        </table>
        <button class="back" onclick="window.location.href='staff_dashboard.php';">BACK</button>    
    </div>
</body>
</html>
