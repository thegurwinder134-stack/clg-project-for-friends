<nav class="navbar">
    <div class="nav-container">
        <div class="nav-logo">
            <a href="index.php">Fashion Hub</a>
        </div>
        <ul class="nav-menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="category.php?cat=men">Men</a></li>
            <li><a href="category.php?cat=women">Women</a></li>
            <li><a href="cart.php" class="cart-link">Cart <span class="cart-count">0</span></a></li>
            <?php if (isLoggedIn()): ?>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</nav>
