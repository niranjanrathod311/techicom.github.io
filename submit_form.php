<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "techicom_getquote"; 

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $business_email = mysqli_real_escape_string($conn, $_POST['business_email']);
    $business_mobile = mysqli_real_escape_string($conn, $_POST['business_mobile']);
    $business_name = mysqli_real_escape_string($conn, $_POST['business_name']);
    $business_size = mysqli_real_escape_string($conn, $_POST['business_size']);
    $service_interests = isset($_POST['service_interests']) ? implode(', ', $_POST['service_interests']) : '';
    $start_time = mysqli_real_escape_string($conn, $_POST['start_time']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $consent = isset($_POST['consent']) ? 1 : 0; 

    // Correct SQL query
    $sql = "INSERT INTO `form_submissions`(`name`, `gender`, `business_email`, `business_mobile`, `business_name`, `business_size`, `service_interests`, `start_time`, `details`, `consent`) 
            VALUES ('$name', '$gender', '$business_email', '$business_mobile', '$business_name', '$business_size', '$service_interests', '$start_time', '$details', '$consent')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
