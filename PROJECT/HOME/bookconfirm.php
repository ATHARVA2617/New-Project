<?php
// Database connection details
$servername = "localhost";  // Change if necessary
$username = "root";         // Change if you have a different DB user
$password = "";             // Change if your MySQL has a password
$dbname = "car_wash";       // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$car_model = $_POST['car_model'];
$service_type = $_POST['service_type'];
$booking_date = $_POST['date'];

// SQL query to insert booking details
$sql = "INSERT INTO bookings (name, car_model, service_type, booking_date) 
        VALUES ('$name', '$car_model', '$service_type', '$booking_date')";

if ($conn->query($sql) === TRUE) {
    // Redirect to Main.html after successful booking
    header("Location: Main.html");
    exit(); // Stop script execution after redirection
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
