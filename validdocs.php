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

// Fetch valid doctors with schedules
$sql = "SELECT doctordetails.firstname, doctordetails.doctorID, doctordetails.qualification, 
               doctorschedule.location, doctorschedule.date, doctorschedule.time 
        FROM doctordetails 
        INNER JOIN doctorschedule ON doctordetails.doctorID = doctorschedule.doctorID 
        ORDER BY doctorschedule.date, doctorschedule.time";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valid Doctors</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #28a745;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .remove-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .remove-btn:hover {
            background-color: #0056b3;
        }
        .back-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 5px 15px;
            font-size: 14px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        .back-btn:hover {
            background-color: #0056b3;
        }
        .header {
            background: #5e2ff8;
            color:  white;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center; 
            border-radius: 10px 10px 0 0;
            margin: 10px auto;
            font-size: 24px; /* Optional: Increase text size */
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Available Doctors</h2>
    </div>
    <div class="container">
        <table>
            <tr>
                <th>First Name</th>
                <th>Doctor ID</th>
                <th>Qualification</th>
                <th>Location</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['firstname']) . "</td>
                            <td>" . htmlspecialchars($row['doctorID']) . "</td>
                            <td>" . htmlspecialchars($row['qualification']) . "</td>
                            <td>" . htmlspecialchars($row['location']) . "</td>
                            <td>" . htmlspecialchars($row['date']) . "</td>
                            <td>" . htmlspecialchars($row['time']) . "</td> 
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No doctors available at the moment</td></tr>";
            }
            ?>
        </table>

        <!-- Back Button -->
        <a href="patientdashboard.php" class="back-btn">Back</a>
    </div>
</body>
</html>
<?php
$conn->close();
?>
