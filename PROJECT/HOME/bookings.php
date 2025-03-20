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

// Fetch bookings from the database
$sql = "SELECT id, name, car_model, service_type, booking_date FROM bookings ORDER BY booking_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings - Car Wash</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #B0E0E6;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #00796b;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .back-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-btn:hover {
            background-color: #00796b;
        }
    </style>
</head>
<body>

    <h1>Your Bookings</h1>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Car Model</th>
            <th>Service Type</th>
            <th>Booking Date</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['car_model']}</td>
                        <td>{$row['service_type']}</td>
                        <td>{$row['booking_date']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No bookings found.</td></tr>";
        }
        $conn->close();
        ?>

    </table>

    <a href="Main.html" class="back-btn">Back to Home</a>

</body>
</html>
