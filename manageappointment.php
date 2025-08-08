<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Care Compass Hospital";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all patients
$sql = "SELECT * FROM appointments";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: rgb(14, 137, 185);
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
        }
        .container {
            width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 20px 35px rgba(0, 0, 1, 0.9);
        }
        table {
            text-align: center;
        }
        h2 {
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 8px 15px;
            font-size: 14px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            text-align: center;
            width: 100px;
            text-align: center; 
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
    <h2>Appointment List</h2>
    <table border="3">
        <tr>
            <th>Appointment ID</th>
            <th>Patient ID</th>
            <th>Doctor ID</th>
            <th>qualification</th>
            <th>date</th>
            <th>contact</th>
            <th>Action</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['patientID'] . "</td>";
                echo "<td>" . $row['doctorID'] . "</td>";
                echo "<td>" . $row['qualification'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['contact'] . "</td>";
                echo "<td>
                            <a href='changeappointment.php?id=" . $row['id'] . "' class='btn'>Edit</a>
                            <a href='removeappointment.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to remove this id?\");' class='btn'>Remove</a>
                        </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No patient found</td></tr>";
        }
        ?>

    </table>
    <div style="text-align: center; margin-top: 10px;">
    <a href="admindashboard.php" class="btn">Back</a>
    </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
