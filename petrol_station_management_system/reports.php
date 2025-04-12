<?php
// Reports management for the petrol station
session_start();
include 'config.php';
include 'functions.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch sales report
function getSalesReport($conn) {
    $stmt = $conn->prepare("SELECT * FROM sales");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch purchases report
function getPurchasesReport($conn) {
    $stmt = $conn->prepare("SELECT * FROM purchases");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch expenses report
function getExpensesReport($conn) {
    $stmt = $conn->prepare("SELECT * FROM expenses");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Example usage
$salesReport = getSalesReport($conn);
$purchasesReport = getPurchasesReport($conn);
$expensesReport = getExpensesReport($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reports Management</title>
</head>
<body>
    <h1>Reports Management</h1>
    <h2>Sales Report</h2>
    <pre><?php print_r($salesReport); ?></pre>
    
    <h2>Purchases Report</h2>
    <pre><?php print_r($purchasesReport); ?></pre>
    
    <h2>Expenses Report</h2>
    <pre><?php print_r($expensesReport); ?></pre>
</body>
</html>
