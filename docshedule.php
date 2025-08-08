<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Care Compass Hospital";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if doctor is logged in
if (!isset($_SESSION['doctorID'])) {
    die("You must be logged in as a doctor.");
}

$doctorID = $_SESSION['doctorID'];

$location = "";
$date = "";
$time = "";
$number ="";

// Check if the doctor already has a schedule
$sql = "SELECT location, date, time, number FROM doctorschedule WHERE doctorID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $doctorID);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // Schedule exists, load data
    $location = $row['location'];
    $date = $row['date'];
    $time = $row['time'];
    $contactnum = $row['number'];
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $location = $_POST['location'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $number = $_POST['number'];

    // Check if a record already exists
    $check_sql = "SELECT doctorID FROM doctorschedule WHERE doctorID = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $doctorID);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // Update existing record
        $update_sql = "UPDATE doctorschedule SET location = ?, date = ?, time = ?, number = ? WHERE doctorID = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sssss", $location, $date, $time, $number, $doctorID);

        if ($update_stmt->execute()) {
            echo "<script>alert('Schedule updated successfully!'); window.location.href='doctordashboard.php';</script>";
        } else {
            echo "<script>alert('Update failed!');</script>";
        }
    } else {
        // Insert new record
        $insert_sql = "INSERT INTO doctorschedule (doctorID, location, date, time, number) VALUES (?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("sssss", $doctorID, $location, $date, $time, $number);

        if ($insert_stmt->execute()) {
            echo "<script>alert('Schedule added successfully!'); window.location.href='doctordashboard.php';</script>";
        } else {
            echo "<script>alert('Insert failed!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Schedule</title>
    <style>body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 600px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
            color: #010201;
        }

        input[type="text"], input[type="date"], input[type="time"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            background-color: #218838;
        }

        .btn {
            background-color: #007bff;
            text-align: center;
            margin-top: 20px;
            width: 30%;
            padding: 12px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
    <h2>Update Your Schedule</h2>
    <form method="POST" action="">
        <label for="location">Hospital Location:</label>
        <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($location); ?>" required>

        <label for="date">Duty Date:</label>
        <input type="date" id="date" name="date" value="<?php echo $date; ?>" required>

        <label for="time">Duty Time:</label>
        <input type="time" id="time" name="time" value="<?php echo $time; ?>" required>

        <label for="number">Contact Number:</label>
        <input type="text" id="number" name="number" value="<?php echo $number; ?>" required>

        <button type="submit">Save Schedule</button>
    </form>

    <button class="btn" onclick="window.location.href='doctordashboard.php';">Cancel</button>
    </div>
</body>
</html>
