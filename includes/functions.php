<?php
function getProducts($pdo, $limit = null) {
    $sql = "SELECT * FROM products ORDER BY created_at DESC";
    if ($limit) {
        $sql .= " LIMIT $limit";
    }
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProductImageSrc($image) {
    if (!$image) {
        return 'uploads/031-women-black-midi-dress-dresses.webp';
    }
    if (preg_match('/^https?:\/\//i', $image)) {
        return $image;
    }
    return 'uploads/' . $image;
}

function e($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function formatPrice($price) {
    return 'Rs. ' . number_format((float) $price, 0);
}

function renderProductCard($product, $extraClass = '') {
    $stockClass = ((int) $product['stock'] > 0) ? 'in-stock' : 'out-stock';
    $stockText = ((int) $product['stock'] > 0) ? $product['stock'] . ' in stock' : 'Out of stock';

    echo '<article class="product-card ' . e($extraClass) . '">';
    echo '<a class="product-media" href="product.php?id=' . e($product['id']) . '">';
    echo '<img src="' . e(getProductImageSrc($product['image'])) . '" alt="' . e($product['name']) . '" class="product-image">';
    echo '<span class="product-badge">' . e($product['brand_style'] ?: ucfirst($product['category'])) . '</span>';
    echo '<span class="product-code">FH-' . e(str_pad($product['id'], 3, '0', STR_PAD_LEFT)) . '</span>';
    echo '</a>';
    echo '<div class="product-info">';
    echo '<p class="product-kicker">' . e(ucfirst($product['category'])) . ' Collection</p>';
    echo '<h3 class="product-name">' . e($product['name']) . '</h3>';
    echo '<div class="product-meta">';
    echo '<p class="product-price">' . e(formatPrice($product['price'])) . '</p>';
    echo '<span class="stock-pill ' . e($stockClass) . '">' . e($stockText) . '</span>';
    echo '</div>';
    echo '<a href="product.php?id=' . e($product['id']) . '" class="btn btn-small">View Details</a>';
    echo '</div>';
    echo '</article>';
}

function getProductById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getProductsByCategory($pdo, $category) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE category = ?");
    $stmt->execute([$category]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addToCart($pdo, $user_id, $product_id, $quantity) {
    $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $product_id, $quantity]);
}

function getCartItems($pdo, $user_id) {
    $stmt = $pdo->prepare("
        SELECT c.*, p.name, p.price, p.image
        FROM cart c
        JOIN products p ON c.product_id = p.id
        WHERE c.user_id = ?
    ");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCartTotal($pdo, $user_id) {
    $stmt = $pdo->prepare("
        SELECT SUM(p.price * c.quantity) as total
        FROM cart c
        JOIN products p ON c.product_id = p.id
        WHERE c.user_id = ?
    ");
    $stmt->execute([$user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

function clearCart($pdo, $user_id) {
    $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmt->execute([$user_id]);
}

function createOrder($pdo, $user_id, $total, $address, $phone) {
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total, address, phone) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $total, $address, $phone]);
    return $pdo->lastInsertId();
}

function addOrderItems($pdo, $order_id, $cart_items) {
    foreach ($cart_items as $item) {
        $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$order_id, $item['product_id'], $item['quantity'], $item['price']]);
    }
}
?>
