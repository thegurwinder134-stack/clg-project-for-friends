<?php
require_once 'config/db.php';
require_once 'includes/auth.php';

header('Content-Type: application/json');

if (!isLoggedIn()) {
    echo json_encode(['success' => false]);
    exit;
}

$cart_id = $_POST['cart_id'] ?? 0;

if ($cart_id) {
    $stmt = $pdo->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
    $stmt->execute([$cart_id, $_SESSION['user_id']]);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>