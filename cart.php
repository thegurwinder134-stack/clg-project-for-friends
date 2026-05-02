<?php
require_once 'config/db.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';

requireLogin();

$user_id = $_SESSION['user_id'];
$cart_items = getCartItems($pdo, $user_id);
$total = getCartTotal($pdo, $user_id);
?>

<?php include 'includes/header.php'; ?>

<section class="section cart">
    <div class="section-header">
        <div>
            <p class="section-eyebrow">Shopping bag</p>
            <h2>Your Cart</h2>
        </div>
        <a href="shop.php" class="btn">Continue Shopping</a>
    </div>

    <?php if (empty($cart_items)): ?>
        <div class="cart-total">
            <h3>Your cart is empty.</h3>
            <p>Start with the latest premium picks from the shop.</p>
            <br>
            <a href="shop.php" class="btn btn-primary">Shop Now</a>
        </div>
    <?php else: ?>
        <div class="cart-items">
            <?php foreach ($cart_items as $item): ?>
                <div class="cart-item">
                    <img src="<?php echo e(getProductImageSrc($item['image'])); ?>" alt="<?php echo e($item['name']); ?>" class="cart-item-image">
                    <div class="cart-item-info">
                        <h3><?php echo e($item['name']); ?></h3>
                        <p><?php echo e(formatPrice($item['price'])); ?></p>
                        <div class="quantity-controls">
                            <button onclick="updateQuantity(<?php echo e($item['id']); ?>, <?php echo e($item['quantity'] - 1); ?>)">-</button>
                            <span><?php echo e($item['quantity']); ?></span>
                            <button onclick="updateQuantity(<?php echo e($item['id']); ?>, <?php echo e($item['quantity'] + 1); ?>)">+</button>
                        </div>
                        <button onclick="removeFromCart(<?php echo e($item['id']); ?>)" class="btn remove-btn">Remove</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="cart-total">
            <p class="section-eyebrow">Order total</p>
            <h3><?php echo e(formatPrice($total)); ?></h3>
            <br>
            <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
        </div>
    <?php endif; ?>
</section>

<?php include 'includes/footer.php'; ?>
