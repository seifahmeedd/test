<?php
session_start();
require_once 'db.php';
require_once 'controllers/EventController.php';

$controller = new EventController($conn);
$controller->index();