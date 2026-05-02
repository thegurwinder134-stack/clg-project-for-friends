<?php
require_once 'includes/auth.php';
requireLogin();
?>

<?php include 'includes/header.php'; ?>

<section class="section success">
    <div class="success-container">
        <p class="section-eyebrow">Order complete</p>
        <h2>Order Successful!</h2>
        <p>Thank you for your purchase. Your order has been placed successfully.</p>
        <p>You will receive a confirmation email shortly.</p>
        <br>
        <a href="index.php" class="btn btn-primary">Continue Shopping</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
