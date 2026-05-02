<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

function loginUser($pdo, $email, $password) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        return true;
    }
    return false;
}

function registerUser($pdo, $name, $email, $password) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    return $stmt->execute([$name, $email, $hashed_password]);
}

function logoutUser() {
    session_destroy();
    header('Location: index.php');
    exit;
}
?>