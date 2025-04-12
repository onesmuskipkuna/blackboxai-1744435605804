<?php
// Expenses management for the petrol station
session_start();
include 'config.php';
include 'functions.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $date = date('Y-m-d H:i:s');

    // Log the expense in the database
    $stmt = $conn->prepare("INSERT INTO expenses (description, amount, date) VALUES (:description, :amount, :date)");
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':date', $date);
    $stmt->execute();

    echo "Expense logged successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Expenses Management</title>
</head>
<body>
    <h1>Expenses Management</h1>
    <form method="POST" action="">
        <input type="text" name="description" placeholder="Expense Description" required>
        <input type="number" name="amount" placeholder="Amount" required>
        <button type="submit">Log Expense</button>
    </form>
</body>
</html>
