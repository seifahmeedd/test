<?php
require_once __DIR__ . '/../models/Event.php';

class EventController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /* ---------------- PUBLIC: EVENTS LIST ---------------- */
    public function index() {
        $events = Event::all($this->conn);

        if ($events === null) {
            $error = "Unable to load events.";
            include __DIR__ . '/../views/error.php';
            return;
        }

        include __DIR__ . '/../views/events/index.php';
    }

    /* ---------------- PUBLIC: EVENT DETAILS ---------------- */
    public function showDetails($id) {
        $event = Event::getById($this->conn, $id);

        if (!$event) {
            $error = "Event not found.";
            include __DIR__ . '/../views/error.php';
            return;
        }

        include __DIR__ . '/../views/events/eventDetails.php';
    }
}