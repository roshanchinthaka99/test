<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Care Compass Hospital"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if userID is provided
if (isset($_GET['staffID'])) {
    $staffID = $_GET['staffID'];

    $stmt2 = $conn->prepare("DELETE FROM staffdetails WHERE staffID = ?");
    $stmt2->bind_param("s", $staffID);
    $stmt2->execute();
    
    if ($stmt1->affected_rows > 0 || $stmt2->affected_rows > 0) {
        echo "<script>alert('staff removed successfully.'); window.location.href='adminselectstaffs.php';</script>";
    } else {
        echo "<script>alert('Error: staff not found.'); window.location.href='adminselectstaffs.php';</script>";
    }

    $stmt1->close();
    $stmt2->close();
}

$conn->close();
?>
