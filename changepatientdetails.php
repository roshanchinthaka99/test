<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Care Compass Hospital";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['patientID'])) {
    $patientID = $_GET['patientID'];
    $sql = "SELECT * FROM patientdetails WHERE patientID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $patientID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $patient = $result->fetch_assoc();
    } else {
        echo "Patient not found!";
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Doctor Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        label {
            font-size: 16px;
            margin: 10px 0;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #2196F3;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            
        }
        .back:hover {
            background-color: #0b7dda;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Update Doctor Details</h2>
    <form action="updatepatient.php" method="POST">
        <label for="patientID">Patient ID:</label>
        <input type="text" name="patientID" value="<?php echo $patient['patientID']; ?>">

        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" value="<?php echo $patient['firstname']; ?>" required>

        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" value="<?php echo $patient['lastname']; ?>" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="confirmpassword">Confirm Password:</label>
        <input type="password" id="confirmpassword" name="confirmpassword" required>

        <input type="submit" value="Update">
    </form>
    <div class="btn"></div>
    <a href="admindashboard.php" class="back">Back</a>
    </div>
</div>

</body>
</html>

<?php
$conn->close();
?>
