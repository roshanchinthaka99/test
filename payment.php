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
    $patientID = $_POST['patientID'];
    $appointmentID = $_POST['appointmentID'];
    $totalamount = $_POST['totalamount'];
    $paymentmethod = $_POST['paymentmethod'];

    $sql = "INSERT INTO payments (patientID, appointmentID, totalamount, paymentstatus, paymentmethod)
            VALUES (?, ?, ?, 'Paid', ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iids", $patientID, $appointmentID, $totalamount, $paymentmethod);

    if ($stmt->execute()) {
        echo "<script>alert('Payment Successful!'); window.location.href='patientdashboard.php?patientIID=$patientID';</script>";
    } else {
        echo "<script>alert('Payment Failed!');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patient Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #c9d6ff, #e2e2e2);
            text-align: center;
        }
        .container {
            background: white;
            padding: 20px;
            width: 40%;
            margin: auto;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.3);
        }
        input, select {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Patient Payment</h2>
        <form action="" method="POST">
            <label for="patientID">Patient ID:</label>
            <input type="text" name="patientID" required>

            <label for="appointmentID">Appointment ID:</label>
            <input type="text" name="appointmentID" required>

            <label for="totalamount">Total Amount:</label>
            <input type="text" name="totalamount" required>

            <label for="paymentmethod">Payment Method:</label>
            <select name="paymentmethod" required>
                <option value="Cash">Cash</option>
                <option value="Card">Card</option>
                <option value="Online">Online</option>
            </select>

            <button type="submit">Submit Payment</button>
        </form>
    </div>
</body>
</html>
