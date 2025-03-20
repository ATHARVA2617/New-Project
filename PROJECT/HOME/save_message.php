<?php
$servername = "localhost"; // Change if needed
$username = "root"; // Your database username
$password = ""; // Your database password
$database = "car_wash"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Prepare SQL statement
$sql = "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
    echo "<script>
            alert('Message sent successfully!');
            window.location.href = 'Contact.html';
          </script>";
} else {
    echo "<script>
            alert('Error: Unable to send message.');
            window.location.href = 'Contact.html';
          </script>";
}

// Close connection
$stmt->close();
$conn->close();
?>
