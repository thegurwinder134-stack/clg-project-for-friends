<?php
require_once 'config/db.php';
require_once 'includes/auth.php';

header('Content-Type: application/json');

if (!isLoggedIn()) {
    echo json_encode(['success' => false]);
    exit;
}

$cart_id = $_POST['cart_id'] ?? 0;
$quantity = $_POST['quantity'] ?? 1;

if ($cart_id && $quantity > 0) {
    $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE id = ? AND user_id = ?");
    $stmt->execute([$quantity, $cart_id, $_SESSION['user_id']]);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>