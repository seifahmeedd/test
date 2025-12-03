<?php
require_once __DIR__ . '/../models/Event.php';
require_once __DIR__ . '/../models/User.php';

class AdminController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /* ---------------- ADMIN: DASHBOARD ---------------- */
    public function dashboard() {
        $events = Event::all($this->conn);
        $totalUsers = User::count($this->conn);

        $totalTickets = $this->conn->query("SELECT COUNT(*) AS cnt FROM tickets")->fetch_assoc()['cnt'] ?? 0;
        $totalRevenue = $this->conn->query("SELECT COALESCE(SUM(total), 0) AS sum_total FROM orders WHERE status = 'paid'")->fetch_assoc()['sum_total'] ?? 0;
        $activeEvents = $this->conn->query("SELECT COUNT(*) AS cnt FROM events WHERE status = 'active'")->fetch_assoc()['cnt'] ?? 0;

        include __DIR__ . '/../views/admin/dashboard.php';
    }

    /* ---------------- ADMIN: EVENTS LIST ---------------- */
    public function events() {
        $events = [];
        $result = $this->conn->query("SELECT * FROM events ORDER BY id ASC");
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $events[] = $row;
            }
        }
        include __DIR__ . '/../views/admin/events.php';
    }

    /* ---------------- ADMIN: ADD EVENT ---------------- */
    public function addEvent() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title       = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $venue       = trim($_POST['venue'] ?? '');
            $date        = $_POST['date'] ?? '';
            $time        = $_POST['time'] ?? '';
            $category    = $_POST['category'] ?? '';
            $capacity    = (int)($_POST['capacity'] ?? 0);
            $price       = (float)($_POST['price'] ?? 0);
            $status      = $_POST['status'] ?? 'active';

            if (Event::create($this->conn, $title, $description, $venue, $date, $time, $category, $capacity, $price, $status)) {
                header("Location: admin.php?action=events&msg=added");
                exit;
            } else {
                $error = "Error adding event.";
            }
        }
        include __DIR__ . '/../views/admin/addEvent.php';
    }

    /* ---------------- ADMIN: EDIT EVENT ---------------- */
    public function editEvent($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title       = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $venue       = trim($_POST['venue'] ?? '');
            $date        = $_POST['date'] ?? '';
            $time        = $_POST['time'] ?? '';
            $category    = $_POST['category'] ?? '';
            $capacity    = (int)($_POST['capacity'] ?? 0);
            $price       = (float)($_POST['price'] ?? 0);
            $status      = $_POST['status'] ?? 'active';

            if (Event::update($this->conn, $id, $title, $description, $venue, $date, $time, $category, $capacity, $price, $status)) {
                header("Location: admin.php?action=events&msg=updated");
                exit;
            } else {
                $error = "Error updating event.";
                $event = Event::getById($this->conn, $id);
            }
        } else {
            $event = Event::getById($this->conn, $id);
            if (!$event) {
                $error = "Event not found.";
                // Instead of error.php, just show the events list with error
                header("Location: admin.php?action=events&msg=notfound");
                exit;
            }
        }
        include __DIR__ . '/../views/admin/editEvent.php';
    }

    /* ---------------- ADMIN: DELETE EVENT ---------------- */
    public function deleteEvent($id) {
        if (Event::delete($this->conn, $id)) {
            header("Location: admin.php?action=events&msg=deleted");
            exit;
        } else {
            $error = "Error deleting event.";
            // Redirect back to events list with error message
            header("Location: admin.php?action=events&msg=deleteerror");
            exit;
        }
    }

    /* ---------------- ADMIN: LOGS ---------------- */
    public function logs() {
        $logs = [];
        $result = $this->conn->query("SELECT * FROM logs ORDER BY timestamp ASC");
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $logs[] = $row;
            }
        }
        include __DIR__ . '/../views/admin/logs.php';
    }
}