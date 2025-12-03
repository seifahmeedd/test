<?php
session_start();
require_once 'db.php';                // database connection
require_once 'controllers/UserController.php';

$controller = new UserController($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle registration attempt
    $username        = trim($_POST['username'] ?? '');
    $email           = trim($_POST['email'] ?? '');
    $password        = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    try {
        $controller->register($username, $email, $password, $confirmPassword);
    } catch (Exception $e) {
        // Store error message in session and reload the form
        $_SESSION['error'] = $e->getMessage();
        header("Location: register.php");
        exit;
    }
} else {
    // Show registration form
    $controller->showRegister();
}