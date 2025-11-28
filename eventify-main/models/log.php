<?php
class Log {
    /* ---------------- CREATE ---------------- */
    public static function add($conn, $userId, $action, $status) {
        $sql = "INSERT INTO logs (user_id, action, status, timestamp)
                VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("iss", $userId, $action, $status);
        return $stmt->execute();
    }

    /* ---------------- READ ---------------- */
    public static function all($conn) {
        $sql = "SELECT l.id, u.name AS username, l.action, l.status, l.timestamp
                FROM logs l
                JOIN users u ON l.user_id = u.id
                ORDER BY l.timestamp DESC";
        $result = $conn->query($sql);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function getByUser($conn, $userId) {
        $sql = "SELECT l.id, u.name AS username, l.action, l.status, l.timestamp
                FROM logs l
                JOIN users u ON l.user_id = u.id
                WHERE l.user_id = ?
                ORDER BY l.timestamp DESC";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            return [];
        }
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function getById($conn, $id) {
        $sql = "SELECT l.id, u.name AS username, l.action, l.status, l.timestamp
                FROM logs l
                JOIN users u ON l.user_id = u.id
                WHERE l.id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            return null;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_assoc() : null;
    }

    /* ---------------- UTILITIES ---------------- */
    public static function count($conn) {
        $sql = "SELECT COUNT(*) AS cnt FROM logs";
        $result = $conn->query($sql);
        return $result ? (int)$result->fetch_assoc()['cnt'] : 0;
    }
}