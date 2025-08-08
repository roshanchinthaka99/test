<?php
session_start();
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

// Check if doctor is logged in (assuming they log in using doctorID)
if (!isset($_SESSION['doctorID'])) {
    echo "<script>alert('Please log in first!'); window.location.href='doctorlogin.php';</script>";
    exit();
}

$doctorID = $_SESSION['doctorID']; // Get logged-in doctor ID

// Fetch existing doctor details
$sql = "SELECT firstname, lastname FROM doctordetails WHERE doctorID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $doctorID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
} else {
    echo "<script>alert('Doctor record not found!'); window.location.href='doctordashboard.php';</script>";
    exit();
}

// Handle update request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newFirstname = $_POST['firstname'];
    $newLastname = $_POST['lastname'];

    // Update the database
    $updateSql = "UPDATE doctordetails SET firstname = ?, lastname = ? WHERE doctorID = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("sss", $newFirstname, $newLastname, $doctorID);

    if ($updateStmt->execute()) {
        echo "<script>alert('Profile updated successfully!'); window.location.href='doctordashboard.php';</script>";
    } else {
        echo "<script>alert('Error updating profile!');</script>";
    }

    $updateStmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
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
        h2 {
            text-align: center;
        }
        input[type="text"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #218838;
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
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>

<div class="container">
    <h2>Update Profile</h2>
    <form method="POST" action="">
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>" required>

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>" required>

        <input type="submit" value="Update Profile">
    </form>

    <div style="text-align: center; margin-top: 10px;">
    <a href="doctordashboard.php" class="btn">Back</a>
</div>

</div>

</body>
</html>
