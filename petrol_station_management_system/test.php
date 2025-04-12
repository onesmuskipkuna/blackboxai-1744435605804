<?php
session_start();
include 'config.php';
include 'functions.php';

// Test user authentication
if (authenticate('testuser', 'testpassword')) {
    echo "User authenticated successfully.\n";
    
    // Test logging a sale
    $saleData = [
        'product_id' => 1,
        'quantity' => 2,
        'price' => 10.00
    ];
    logSale($saleData);
    echo "Sale logged successfully.\n";
    
    // Test generating a report
    $salesReport = generateReport('sales');
    print_r($salesReport);
} else {
    echo "Authentication failed.\n";
}
?>
