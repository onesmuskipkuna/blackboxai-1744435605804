<?php
function authenticate($username, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $stmt->execute(['username' => $username, 'password' => md5($password)]);
    $user = $stmt->fetch();
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        return true;
    }
    return false;
}

function logSale($data) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO sales (product_id, quantity, price, user_id) VALUES (:product_id, :quantity, :price, :user_id)");
    $stmt->execute([
        'product_id' => $data['product_id'],
        'quantity' => $data['quantity'],
        'price' => $data['price'],
        'user_id' => $_SESSION['user_id']
    ]);
}

function generateReport($type) {
    global $conn;
    // Example implementation for sales report
    if ($type === 'sales') {
        $stmt = $conn->query("SELECT * FROM sales");
        return $stmt->fetchAll();
    }
}
?>
