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
if (isset($_GET['patientID'])) {
    $patientID = $_GET['patientID'];

    $stmt2 = $conn->prepare("DELETE FROM patientdetails WHERE patientID = ?");
    $stmt2->bind_param("s", $patientID);
    $stmt2->execute();
    
    if ($stmt1->affected_rows > 0 || $stmt2->affected_rows > 0) {
        echo "<script>alert('Patient removed successfully.'); window.location.href='adminselectpatients.php';</script>";
    } else {
        echo "<script>alert('Error: Patient not found.'); window.location.href='adminselectpatients.php';</script>";
    }

    $stmt1->close();
    $stmt2->close();
}

$conn->close();
?>
