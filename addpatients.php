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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $patientID = $_POST['patientID'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match!'); window.location.href='admindashboard.php';</script>";
        exit();
    }

    
    $sql = "INSERT INTO patientdetails (firstname, lastname, patientID, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters for the SQL query
    $stmt->bind_param("ssss", $firstname, $lastname, $patientID, $password);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href='admindashboard.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='addpatients.php';</script>";
    }
    
    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Care Compass Hospital</title>
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
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin: 50px auto;
            box-shadow: 0 20px 35px rgba(0, 0, 1, 0.9);
        }
        h2 {
            text-align: center;
        }
        input[type="text"], input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        button {
            background-color: #dc3545; /* Red color for cancel */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 25%; /* Adjust width as needed */
            display: block;
            margin: 15px auto; /* Center the button */
            text-align: center;
        }
        button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Add Patients</h2>
    <form method="POST" action="">
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" required>

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" required>

        <label for="patientID">Patient ID:</label>
        <input type="text" name="patientID" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <label for="confirmpassword">Confirm Password:</label>
        <input type="password" name="confirmpassword" required>

        <input type="submit" value="Register">
    </form>
    <button onclick="window.location.href='admindashboard.php';">Cancel</button>
</div>
</body>
</html>
