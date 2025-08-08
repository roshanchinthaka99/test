<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Care Compass Hospital";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientID = $_POST['patientID'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "Passwords do not match!";
        exit();
    }

    // Update doctor details in the database
    $sql = "UPDATE patientdetails SET firstname = ?, lastname = ?, password = ? WHERE patientID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $firstname, $lastname, $password, $patientID);

    if ($stmt->execute()) {
        echo "<script>alert('Patient details updated successfully!'); window.location.href='adminselectpatients.php';</script>";
    } else {
        echo "Error updating Patient details: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
