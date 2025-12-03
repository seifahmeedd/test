<?php
session_start();
require_once 'db.php';
require_once 'controllers/EventController.php';

// Instantiate controller
$controller = new EventController($conn);

// Determine action from query string
$action = $_GET['action'] ?? 'home';
$id     = isset($_GET['id']) ? (int) $_GET['id'] : null;

try {
    switch ($action) {
        case 'home':
            $controller->home();
            break;

        case 'list': // ✅ new case for all events
            $controller->listEvents();
            break;

        case 'details':
            if ($id) {
                $controller->showDetails($id);
            } else {
                // No ID provided → set error and redirect
                $_SESSION['error'] = "Event ID is missing.";
                header("Location: events.php?action=home");
                exit;
            }
            break;

        default:
            // Unknown action → set error and redirect
            $_SESSION['error'] = "Invalid action requested.";
            header("Location: events.php?action=home");
            exit;
    }
} catch (Exception $e) {
    // Catch any runtime errors and redirect with message
    $_SESSION['error'] = $e->getMessage();
    header("Location: events.php?action=home");
    exit;
}