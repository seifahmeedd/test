<?php
session_start();
require_once 'db.php';
require_once 'controllers/TicketController.php';

$controller = new TicketController($conn);

// Determine action and event ID
$action  = $_GET['action'] ?? 'list';
$eventId = isset($_GET['event_id']) ? (int) $_GET['event_id'] : null;

try {
    switch ($action) {
        case 'checkout':
            if ($eventId) {
                $controller->checkout($eventId);
            } else {
                $_SESSION['error'] = "Event ID missing.";
                header("Location: events.php?action=list");
                exit;
            }
            break;

        case 'confirmation':
            if ($eventId) {
                $controller->confirmation($eventId);
            } else {
                $_SESSION['error'] = "Event ID missing for confirmation.";
                header("Location: events.php?action=list");
                exit;
            }
            break;
    }
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    header("Location: events.php?action=list");
    exit;
}