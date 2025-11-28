<?php
session_start();
require_once 'db.php';                // database connection
require_once 'controllers/UserController.php';

$controller = new UserController($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle login attempt
    $controller->login($_POST['email'], $_POST['password']);
} else {
    // Show login form
    $controller->showLogin();
}