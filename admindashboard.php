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

// Function to safely fetch count
function fetchCount($conn, $table) {
    $result = $conn->query("SELECT COUNT(*) AS count FROM $table");
    if ($result) {
        return $result->fetch_assoc()['count'];
    } else {
        return 0; // Return 0 or handle the error as needed
    }
}

// Fetch counts
$doctorCount = fetchCount($conn, "doctordetails");
$patientCount = fetchCount($conn, "patientdetails");
$appointmentCount = fetchCount($conn, "appointments");
$staffCount = fetchCount($conn, "staffdetails");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <style>
        body{ 
            font-family: Arial, sans-serif;
            color: white;
            background: #c8d7e0;
        }
        .title{
            background: #5e2ff8;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center; 
            border-radius: 10px 10px 0 0;  
        }
        .dashboard { 
            display: flex; 
            gap: 20px; 
            margin: 50px auto;
        }
        .card { 
            padding: 20px; 
            background: rgb(82, 75, 163); 
            border-radius: 10px;
            width: 30%;
            text-align: center; /* Center text */
            display: flex; /* Enables flexbox */
            flex-direction: column; /* Stack items vertically */
            align-items: center; /* Center horizontally */
            justify-content: center; /* Center vertically */
            height: 100px; /* Adjust height as needed */
        }
        .btn-container {
            display: flex; 
            gap: 10px; /* Adds spacing between buttons */
            justify-content: center; /* Centers buttons in the row */
            margin-top: 20px; /* Adds space from dashboard */
        }
        .btn a button {
            padding: 10px 15px;
            background: #5e2ff8;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

.btn a button:hover {
    background: #3c1eb4;
}

    </style>
</head>
<body>
    <div class="title">
    <h2>Admin Dashboard</h2>
    </div>
    <div class="dashboard">
        <div class="card">
            <h3>Doctors</h3>
            <p>Total: <?php echo $doctorCount; ?></p>
        </div>
        <div class="card">
            <h3>Patients</h3>
            <p>Total: <?php echo $patientCount; ?></p>
        </div>
        <div class="card">
            <h3>Appointments</h3>
            <p>Total: <?php echo $appointmentCount; ?></p>
        </div>
        <div class="card">
            <h3>Staff</h3>
            <p>Total: <?php echo $staffCount; ?></p>
        </div>
    </div>

    <div class="btn-container">
    <div class="btn">
        <a href="addpatients.php">   
            <button>Add Patients</button>
        </a>
    </div>
    <div class="btn">
        <a href="adddoctors.php">   
            <button>Add Doctors</button>
        </a>
    </div>
    <div class="btn">
        <a href="addstaff.php">   
            <button>Add Staff</button>
        </a>
    </div>
    <div class="btn">
        <a href="adminselectdocs.php">   
            <button>Manange Doctors</button>
        </a>
    </div>
    <div class="btn">
        <a href="adminselectpatients.php">    
            <button>Manage Patients</button>
        </a>
    </div>
    <div class="btn">
        <a href="adminselectstaffs.php">    
            <button>Manage Staff</button>
        </a>
    </div>
    <div class="btn">
        <a href="manageappointment.php">    
            <button>Manage Appointments</button>
        </a>
    </div>
    <div class="btn">
        <a href="adminservices.php">    
            <button>Services</button>
        </a>
    </div>
    <div class="btn">
        <a href="#">    
            <button>View Feedback</button>
        </a>
    </div>
    <div class="btn">
        <a href="adminlogin.php">    
            <button>Logout</button>
        </a>
    </div>
</div>
</body>
</html>