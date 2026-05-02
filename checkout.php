<?php
require_once 'config/db.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';

requireLogin();

$user_id = $_SESSION['user_id'];
$cart_items = getCartItems($pdo, $user_id);
$total = getCartTotal($pdo, $user_id);

if (empty($cart_items)) {
    header('Location: cart.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $order_id = createOrder($pdo, $user_id, $total, $address, $phone);
    addOrderItems($pdo, $order_id, $cart_items);
    clearCart($pdo, $user_id);

    header('Location: order-success.php');
    exit;
}
?>

<?php include 'includes/header.php'; ?>

<section class="section checkout">
    <div class="section-header">
        <div>
            <p class="section-eyebrow">Final step</p>
            <h2>Checkout</h2>
        </div>
        <p class="section-lead">A simple college-project checkout flow that stores the order and clears the cart.</p>
    </div>

    <div class="checkout-container">
        <div class="order-summary">
            <h3>Order Summary</h3>
            <?php foreach ($cart_items as $item): ?>
                <div class="summary-item">
                    <span><?php echo e($item['name']); ?> x <?php echo e($item['quantity']); ?></span>
                    <span><?php echo e(formatPrice($item['price'] * $item['quantity'])); ?></span>
                </div>
            <?php endforeach; ?>
            <div class="summary-total">
                <strong>Total</strong>
                <strong><?php echo e(formatPrice($total)); ?></strong>
            </div>
        </div>

        <form method="POST" class="checkout-form">
            <h3>Shipping Information</h3>

            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" required></textarea>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" required>
            </div>

            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
