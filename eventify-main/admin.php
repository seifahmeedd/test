<?php
session_start();
require_once 'db.php';

// Require controllers
require_once 'controllers/AdminController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/LogController.php';
require_once 'controllers/TicketController.php';

// Require admin role
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] ?? 'user') !== 'admin') {
    header('Location: login.php');
    exit;
}

// Instantiate controllers
$adminController = new AdminController($conn);
$userController  = new UserController($conn);
$logController   = new LogController($conn);
$ticketController = new TicketController($conn);

// Get action + id from query string
$action = $_GET['action'] ?? 'dashboard';
$id     = $_GET['id'] ?? null;

// Route actions
switch ($action) {
    case 'dashboard':
        $adminController->dashboard();
        break;

    /* ---------------- EVENTS ---------------- */
    case 'addEvent':
        $adminController->addEvent();
        break;

    case 'editEvent':
        if ($id) {
            $adminController->editEvent($id);
        } else {
            echo "Missing event ID.";
        }
        break;

    case 'deleteEvent':
        if ($id) {
            $adminController->deleteEvent($id);
        } else {
            echo "Missing event ID.";
        }
        break;

    /* ---------------- USERS ---------------- */
    case 'addUser':
        $userController->addUser();
        break;

    case 'editUser':
        if ($id) {
            $userController->editUser($id);
        } else {
            echo "Missing user ID.";
        }
        break;

    case 'deleteUser':
        if ($id) {
            $userController->deleteUser($id);
        } else {
            echo "Missing user ID.";
        }
        break;

    /* ---------------- LOGS ---------------- */
    case 'logs':
        $logController->index();
        break;

    /* ---------------- TICKETS ---------------- */
    case 'ticket':
        if ($id) {
            $ticketController->view($id);
        } else {
            echo "Missing ticket ID.";
        }
        break;

    default:
        $adminController->dashboard();
        break;
}