<?php
// Sales management for the petrol station
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
    $payment_mode = $_POST['payment_mode'];
    $date = date('Y-m-d H:i:s');

    // Log the sale in the database
    $stmt = $conn->prepare("INSERT INTO sales (amount, payment_mode, date) VALUES (:amount, :payment_mode, :date)");
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':payment_mode', $payment_mode);
    $stmt->bindParam(':date', $date);
    $stmt->execute();

    echo "Sale logged successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Management</title>
</head>
<body>
    <h1>Sales Management</h1>
    <form method="POST" action="">
        <input type="number" name="amount" placeholder="Amount" required>
        <select name="payment_mode" required>
            <option value="cash">Cash</option>
            <option value="credit_card">Credit Card</option>
            <option value="debit_card">Debit Card</option>
        </select>
        <button type="submit">Log Sale</button>
    </form>
</body>
</html>
