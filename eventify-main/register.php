<?php
session_start();
require_once 'db.php';                // database connection
require_once 'controllers/UserController.php';

$controller = new UserController($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle registration attempt
    $controller->register($_POST['username'], $_POST['email'], $_POST['password']);
} else {
    // Show registration form
    $controller->showRegister();
}