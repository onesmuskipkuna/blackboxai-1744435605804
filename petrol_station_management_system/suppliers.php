<?php
// Suppliers management for the petrol station
session_start();
include 'config.php';
include 'functions.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $contact_info = $_POST['contact_info'];
    $date = date('Y-m-d H:i:s');

    // Log the supplier in the database
    $stmt = $conn->prepare("INSERT INTO suppliers (name, contact_info, date) VALUES (:name, :contact_info, :date)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':contact_info', $contact_info);
    $stmt->bindParam(':date', $date);
    $stmt->execute();

    echo "Supplier logged successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Suppliers Management</title>
</head>
<body>
    <h1>Suppliers Management</h1>
    <form method="POST" action="">
        <input type="text" name="name" placeholder="Supplier Name" required>
        <input type="text" name="contact_info" placeholder="Contact Information" required>
        <button type="submit">Log Supplier</button>
    </form>
</body>
</html>
