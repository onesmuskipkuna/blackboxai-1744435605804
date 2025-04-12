<?php
// Creditors management for the petrol station
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
    $amount_due = $_POST['amount_due'];
    $date = date('Y-m-d H:i:s');

    // Log the creditor in the database
    $stmt = $conn->prepare("INSERT INTO creditors (name, amount_due, date) VALUES (:name, :amount_due, :date)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':amount_due', $amount_due);
    $stmt->bindParam(':date', $date);
    $stmt->execute();

    echo "Creditor logged successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Creditors Management</title>
</head>
<body>
    <h1>Creditors Management</h1>
    <form method="POST" action="">
        <input type="text" name="name" placeholder="Creditor Name" required>
        <input type="number" name="amount_due" placeholder="Amount Due" required>
        <button type="submit">Log Creditor</button>
    </form>
</body>
</html>
