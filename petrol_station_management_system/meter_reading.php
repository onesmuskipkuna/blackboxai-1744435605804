<?php
// Meter reading management for the petrol station
session_start();
include 'config.php';
include 'functions.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reading = $_POST['reading'];
    $date = date('Y-m-d H:i:s');

    // Log the meter reading in the database
    $stmt = $conn->prepare("INSERT INTO meter_reading (reading, date) VALUES (:reading, :date)");
    $stmt->bindParam(':reading', $reading);
    $stmt->bindParam(':date', $date);
    $stmt->execute();

    echo "Meter reading logged successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Meter Reading Management</title>
</head>
<body>
    <h1>Meter Reading Management</h1>
    <form method="POST" action="">
        <input type="number" name="reading" placeholder="Meter Reading" required>
        <button type="submit">Log Meter Reading</button>
    </form>
</body>
</html>
