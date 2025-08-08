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
    $doctorID = $_POST['doctorID'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $qualification = $_POST['qualification'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "Passwords do not match!";
        exit();
    }

    // Update doctor details in the database
    $sql = "UPDATE doctordetails SET firstname = ?, lastname = ?, qualification = ?, password = ? WHERE doctorID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $firstname, $lastname, $qualification, $password, $doctorID);

    if ($stmt->execute()) {
        echo "<script>alert('Doctor details updated successfully!'); window.location.href='adminselectdocs.php';</script>";
    } else {
        echo "Error updating doctor details: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
