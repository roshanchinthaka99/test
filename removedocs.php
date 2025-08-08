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
if (isset($_GET['doctorID'])) {
    $userID = $_GET['doctorID'];

    // Delete doctor from both tables using prepared statements
    $stmt1 = $conn->prepare("DELETE FROM doctorschedule WHERE doctorID = ?");
    $stmt1->bind_param("s", $doctorID);
    $stmt1->execute();

    $stmt2 = $conn->prepare("DELETE FROM doctordetails WHERE doctorID = ?");
    $stmt2->bind_param("s", $doctorID);
    $stmt2->execute();
    
    if ($stmt1->affected_rows > 0 || $stmt2->affected_rows > 0) {
        echo "<script>alert('Doctor removed successfully.'); window.location.href='adminselectdocs.php';</script>";
    } else {
        echo "<script>alert('Error: Doctor not found.'); window.location.href='adminselectdocs.php';</script>";
    }

    $stmt1->close();
    $stmt2->close();
}

$conn->close();
?>
