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
        // Fetch all events
        $events = Event::all($this->conn);

        // Users count
        $totalUsers = User::count($this->conn);

        // Tickets count
        $totalTickets = 0;
        if ($result = $this->conn->query("SELECT COUNT(*) AS cnt FROM tickets")) {
            $row = $result->fetch_assoc();
            $totalTickets = $row['cnt'] ?? 0;
        }

        // Revenue (only paid orders)
        $totalRevenue = 0;
        if ($result = $this->conn->query("SELECT COALESCE(SUM(total), 0) AS sum_total FROM orders WHERE status = 'paid'")) {
            $row = $result->fetch_assoc();
            $totalRevenue = $row['sum_total'] ?? 0;
        }

        // Active events count
        $activeEvents = 0;
        if ($result = $this->conn->query("SELECT COUNT(*) AS cnt FROM events WHERE status = 'active'")) {
            $row = $result->fetch_assoc();
            $activeEvents = $row['cnt'] ?? 0;
        }

        // Load dashboard view
        include __DIR__ . '/../views/admin/dashboard.php';
    }

    /* ---------------- ADMIN: EVENTS ---------------- */
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
                include __DIR__ . '/../views/admin/addEvent.php';
            }
        } else {
            include __DIR__ . '/../views/admin/addEvent.php';
        }
    }

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
                include __DIR__ . '/../views/admin/editEvent.php';
            }
        } else {
            $event = Event::getById($this->conn, $id);
            if ($event) {
                include __DIR__ . '/../views/admin/editEvent.php';
            } else {
                $error = "Event not found.";
                include __DIR__ . '/../views/admin/error.php';
            }
        }
    }

    public function deleteEvent($id) {
        if (Event::delete($this->conn, $id)) {
            header("Location: admin.php?action=events&msg=deleted");
            exit;
        } else {
            $error = "Error deleting event.";
            include __DIR__ . '/../views/admin/error.php';
        }
    }
}