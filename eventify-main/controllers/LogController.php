<?php
require_once __DIR__ . '/../models/Log.php';

class LogController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /* ---------------- ADMIN: LOGS ---------------- */
    public function index() {
        try {
            $logs = Log::all($this->conn);

            if ($logs === null) {
                $logs = [];
            }

            $todayCount = 0;
            $errorCount = 0;

            foreach ($logs as $log) {
                // Count today's logs
                if (isset($log['timestamp']) && substr($log['timestamp'], 0, 10) === date('Y-m-d')) {
                    $todayCount++;
                }
                // Count error logs
                if (isset($log['status']) && $log['status'] === 'error') {
                    $errorCount++;
                }
            }

            include __DIR__ . '/../views/admin/adminLogs.php';
        } catch (Exception $e) {
            $error = "Unable to load logs: " . $e->getMessage();
            include __DIR__ . '/../views/admin/error.php';
        }
    }

}