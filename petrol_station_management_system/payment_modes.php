<?php
// Payment modes management for the petrol station
session_start();
include 'config.php';
include 'functions.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mode = $_POST['mode'];
    $date = date('Y-m-d H:i:s');

    // Log the payment mode in the database
    $stmt = $conn->prepare("INSERT INTO payment_modes (mode, date) VALUES (:mode, :date)");
    $stmt->bindParam(':mode', $mode);
    $stmt->bindParam(':date', $date);
    $stmt->execute();

    echo "Payment mode logged successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Modes Management</title>
</head>
<body>
    <h1>Payment Modes Management</h1>
    <form method="POST" action="">
        <input type="text" name="mode" placeholder="Payment Mode" required>
        <button type="submit">Log Payment Mode</button>
    </form>
</body>
</html>
