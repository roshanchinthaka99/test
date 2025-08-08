<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Care Compass Hospital";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID is set
if (isset($_GET['id'])) {
    $appointmentID = intval($_GET['id']);

    // Fetch appointment data
    $sql = "SELECT * FROM appointments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointmentID);
    $stmt->execute();
    $result = $stmt->get_result();
    $appointment = $result->fetch_assoc();

    if (!$appointment) {
        die("Appointment not found.");
    }
}

// Update Appointment
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientID = $_POST["patientID"];
    $doctorID = $_POST["doctorID"];
    $qualification = $_POST["qualification"];
    $date = $_POST["date"];
    $contact = $_POST["contact"];

    $updateSQL = "UPDATE appointments SET patientID=?, doctorID=?, qualification=?, date=?, contact=? WHERE id=?";
    $stmt = $conn->prepare($updateSQL);
    $stmt->bind_param("iisssi", $patientID, $doctorID, $qualification, $date, $contact, $appointmentID);

    if ($stmt->execute()) {
        echo "<script>alert('Appointment updated successfully!'); window.location='admindashboard.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
        }
        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            width: 100%;
            cursor: pointer;
        }
        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Appointment</h2>
    <form method="POST">
        <label>Patient ID:</label>
        <input type="number" name="patientID" value="<?php echo htmlspecialchars($appointment['patientID']); ?>" required>

        <label>Doctor ID:</label>
        <input type="number" name="doctorID" value="<?php echo htmlspecialchars($appointment['doctorID']); ?>" required>

        <label>Qualification:</label>
        <input type="text" name="qualification" value="<?php echo htmlspecialchars($appointment['qualification']); ?>" required>

        <label>Date:</label>
        <input type="date" name="date" value="<?php echo htmlspecialchars($appointment['date']); ?>" required>

        <label>Contact:</label>
        <input type="text" name="contact" value="<?php echo htmlspecialchars($appointment['contact']); ?>" required>

        <button type="submit" class="btn">Update</button>
    </form>
    <a href="admindashboard.php" class="btn" style="margin-top: 10px; display: block; text-align: center;">Back</a>
</div>

</body>
</html>

<?php
$conn->close();
?>
