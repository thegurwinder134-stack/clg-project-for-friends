<?php
require_once 'config/db.php';
require_once 'includes/auth.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (registerUser($pdo, $name, $email, $password)) {
        $message = 'Registration successful! Please login.';
    } else {
        $message = 'Registration failed. Email may already exist.';
    }
}
?>

<?php include 'includes/header.php'; ?>

<section class="section register">
    <div class="form-container">
        <p class="section-eyebrow">Join Fashion Hub</p>
        <h2>Register</h2>

        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn">Register</button>
        </form>

        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
