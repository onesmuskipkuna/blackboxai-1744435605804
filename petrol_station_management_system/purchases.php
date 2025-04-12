<?php
// Purchases management for the petrol station
session_start();
include 'config.php';
include 'functions.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $supplier_id = $_POST['supplier_id'];
    $date = date('Y-m-d H:i:s');

    // Log the purchase in the database
    $stmt = $conn->prepare("INSERT INTO purchases (amount, supplier_id, date) VALUES (:amount, :supplier_id, :date)");
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':supplier_id', $supplier_id);
    $stmt->bindParam(':date', $date);
    $stmt->execute();

    echo "Purchase logged successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Purchases Management</title>
</head>
<body>
    <h1>Purchases Management</h1>
    <form method="POST" action="">
        <input type="number" name="amount" placeholder="Amount" required>
        <select name="supplier_id" required>
            <!-- Options for suppliers will be populated here -->
        </select>
        <button type="submit">Log Purchase</button>
    </form>
</body>
</html>
