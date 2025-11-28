<?php
require_once 'db.php';
require_once 'controllers/AdminController.php';

$controller = new AdminController($conn);

// Edit Event entry
if (isset($_GET['action']) && $_GET['action'] === 'editEvent') {
    $id = $_GET['id'] ?? null;
    if ($id) {
        $controller->editEvent($id);
    } else {
        echo "Missing event ID.";
    }
}