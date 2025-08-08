<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Care Compass Hospital";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $staffID = $_POST['staffID'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phonenumber = $_POST['phonenumber'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "Passwords do not match!";
        exit();
    }

    // Update staff details in the database
    $sql = "UPDATE staffdetails SET firstname = ?, lastname = ?, phonenumber = ?, password = ? WHERE staffID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $firstname, $lastname, $phonenumber, $password, $staffID);

    if ($stmt->execute()) {
        echo "<script>alert('Staff details updated successfully!'); window.location.href='adminselectstaffs.php';</script>";
    } else {
        echo "Error updating Staff details: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
