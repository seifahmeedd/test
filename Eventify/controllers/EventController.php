<?php
require_once __DIR__ . '/../models/Event.php';

class EventController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /* ---------------- PUBLIC: EVENTS LIST (HOME) ---------------- */
    public function home() {
    $events = Event::all($this->conn); // or Event::all($this->conn)

    // Pass events to the view even if empty
    include __DIR__ . '/../views/home.php';
}

    public function listEvents() {
    $events = Event::all($this->conn);
    include __DIR__ . '/../views/events/Events.php';
}

    /* ---------------- PUBLIC: EVENT DETAILS ---------------- */
    public function showDetails($id) {
        $event = Event::getById($this->conn, $id);

        if (!$event) {
            // Redirect back to home with error message
            header("Location: events.php?action=home&msg=notfound");
            exit;
        }

        include __DIR__ . '/../views/events/details.php';
    }
}