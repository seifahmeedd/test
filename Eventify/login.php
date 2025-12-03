<?php
session_start();
require_once 'db.php';                // database connection
require_once 'controllers/UserController.php';

$controller = new UserController($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle login attempt
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    try {
        $controller->login($email, $password);
    } catch (Exception $e) {
        // Store error message in session and reload login form
        $_SESSION['error'] = $e->getMessage();
        header("Location: users.php?action=login");
        exit;
    }
} else {
    // Show login form
    $controller->showLogin();
}