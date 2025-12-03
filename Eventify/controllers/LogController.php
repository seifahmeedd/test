<?php
class LogController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * Show all logs in the admin panel
     */
    public function index() {
        $sql = "SELECT * FROM logs ORDER BY timestamp DESC"; // newest first
        $result = $this->conn->query($sql);

        $logs = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $logs[] = $row;
            }
        }

        // Pass logs to the view
        include __DIR__ . '/../views/admin/logs.php';
    }

    /**
     * View a single log by ID
     */
    public function view($id) {
        $stmt = $this->conn->prepare("SELECT * FROM logs WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $log = $result->fetch_assoc();

        if (!$log) {
            // Redirect back with error message
            header("Location: admin.php?action=logs&msg=notfound");
            exit;
        }

        include __DIR__ . '/../views/admin/log_view.php';
    }
}