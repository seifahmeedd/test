<?php
session_start();
require_once 'db.php';
require_once 'controllers/UserController.php';

// Require admin role
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] ?? 'user') !== 'admin') {
    header('Location: login.php');
    exit;
}

$controller = new UserController($conn);

// Expect user ID from query string: editUser.php?id=123
if (isset($_GET['id'])) {
    $controller->editUser((int)$_GET['id']);
} else {
    echo "No user ID provided.";
}