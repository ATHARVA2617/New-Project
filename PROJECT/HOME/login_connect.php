<?php
session_start();

$servername = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$dbname = "car_wash";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = trim($_POST['user_id']);  // Ensure field name matches the form
    $password = trim($_POST['password']);

    // Validate fields
    if (empty($user_id) || empty($password)) {
        echo "<script>alert('Both fields are required!'); window.location.href='login.html';</script>";
        exit();
    }

    // Query the database
    $sql = "SELECT * FROM register_user WHERE user_id = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user_id, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        $_SESSION['user_id'] = $user_id;

        // ✅ Ensure no output before redirect
        ob_clean();
        header("Location: Main.html");
        exit();
    } else {
        echo "<script>alert('Invalid User ID or Password!'); window.location.href='login.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
