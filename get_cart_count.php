<?php
require_once 'config/db.php';
require_once 'includes/auth.php';

header('Content-Type: application/json');

if (!isLoggedIn()) {
    echo json_encode(['count' => 0]);
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT SUM(quantity) as count FROM cart WHERE user_id = ?");
$stmt->execute([$user_id]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode(['count' => $result['count'] ?? 0]);
?>