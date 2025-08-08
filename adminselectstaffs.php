<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Care Compass Hospital";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all doctors
$sql = "SELECT * FROM staffdetails";
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
            max-width: 500px;
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
    <h2>Staff List</h2>
    <table border="3">
        <tr>
            <th>Staff ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone Number</th>
            <th>Action</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['staffID'] . "</td>";
                echo "<td>" . $row['firstname'] . "</td>";
                echo "<td>" . $row['lastname'] . "</td>";
                echo "<td>" . $row['phonenumber'] . "</td>";
                echo "<td>
                            <a href='changestaffdetails.php? staffID=" . $row['staffID'] . "' class='btn'>Edit</a>
                            <a href='removestaff.php?staffID=" . $row['staffID'] . "' onclick='return confirm(\"Are you sure you want to remove?\");' class='btn'>Remove</a>
                        </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No staff found</td></tr>";
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
