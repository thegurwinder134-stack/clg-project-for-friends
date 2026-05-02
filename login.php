<?php
require_once 'config/db.php';
require_once 'includes/auth.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (loginUser($pdo, $email, $password)) {
        header('Location: index.php');
        exit;
    } else {
        $message = 'Invalid email or password';
    }
}
?>

<?php include 'includes/header.php'; ?>

<section class="section login">
    <div class="form-container">
        <p class="section-eyebrow">Welcome back</p>
        <h2>Login</h2>

        <?php if ($message): ?>
            <p class="error"><?php echo $message; ?></p>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>

        <p>Demo login: john@example.com / password</p>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
