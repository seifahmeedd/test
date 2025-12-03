<?php
session_start();
require_once 'db.php';
require_once 'controllers/UserController.php';

$controller = new UserController($conn);

// Get action from query string
$action = $_GET['action'] ?? 'dashboard';

switch ($action) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $controller->login($email, $password);
        } else {
            $controller->showLogin();
        }
        break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name            = trim($_POST['name'] ?? '');
            $email           = trim($_POST['email'] ?? '');
            $password        = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            $controller->register($name, $email, $password, $confirmPassword);
        } else {
            $controller->showRegister();
        }
        break;

    case 'dashboard':
    if (!isset($_SESSION['user_id'])) {
        // Guest → redirect to events index
        header("Location: home.php");
        exit;
    }
    $controller->dashboard(); // Logged-in user dashboard
    break;

    case 'logout':
    session_unset();     // clear all session variables
    session_destroy();   // destroy the session itself
    header("Location: users.php?action=login");
    exit;

    default:
    if (!isset($_SESSION['user_id'])) {
        header("Location: home.php");
        exit;
    }
    $controller->dashboard();
    break;
}