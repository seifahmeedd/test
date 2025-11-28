<?php
session_start();
require_once 'db.php';
require_once 'controllers/TicketController.php';

$controller = new TicketController($conn);

if (isset($_GET['id'])) {
    $controller->view($_GET['id']);
} else {
    echo "No ticket selected.";
}