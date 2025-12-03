<?php
session_start();
require_once 'db.php';

// Require controllers
require_once 'controllers/LogController.php';
require_once 'controllers/AdminController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/TicketController.php';

// Require admin role
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] ?? 'user') !== 'admin') {
    header('Location: login.php');
    exit;
}

// Instantiate controllers
$logController     = new LogController($conn);
$adminController   = new AdminController($conn);
$userController    = new UserController($conn);
$ticketController  = new TicketController($conn);

// Get action + id from query string
$action = $_GET['action'] ?? 'dashboard';
$id     = isset($_GET['id']) ? (int) $_GET['id'] : null;

// Route actions
switch ($action) {
    case 'dashboard':
        $adminController->dashboard();
        break;

    case 'users':
        $userController->index(); // show users list
        break;

    case 'events':
        $adminController->events(); // show events list
        break;
    /* ---------------- EVENTS ---------------- */
    case 'addEvent':
        $adminController->addEvent();
        break;
    case 'editEvent':
        $adminController->editEvent($id);
        break;
    case 'deleteEvent':
        $adminController->deleteEvent($id);
        break;

    /* ---------------- USERS ---------------- */
    case 'addUser':
        $userController->addUser();
        break;
    case 'editUser':
        $userController->editUser($id);
        break;
    case 'deleteUser':
        $userController->deleteUser($id);
        break;

    /* ---------------- LOGS ---------------- */
    case 'logs':
        $logController->index();
        break;

    /* ---------------- TICKETS ---------------- */
    case 'ticket':
        $ticketController->view($id);
        break;

    default:
        $adminController->dashboard();
        break;
}