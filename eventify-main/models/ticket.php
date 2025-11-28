<?php
class Ticket {
    /* ---------------- READ ---------------- */
    public static function getById($conn, $ticketId) {
        $sql = "SELECT * FROM tickets WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            return null;
        }
        $stmt->bind_param("i", $ticketId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_assoc() : null;
    }

    public static function allByUser($conn, $userId) {
        $sql = "SELECT * FROM tickets WHERE user_id = ? ORDER BY created_at DESC";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            return [];
        }
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function getByOrderId($conn, $orderId) {
        $sql = "SELECT * FROM tickets WHERE order_id = ? ORDER BY created_at ASC";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            return [];
        }
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    /* ---------------- CREATE ---------------- */
    public static function create($conn, $orderId, $userId, $eventId, $seat, $code, $price, $time) {
        $sql = "INSERT INTO tickets (order_id, user_id, event_id, seat, code, price, time, created_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("iiissds", $orderId, $userId, $eventId, $seat, $code, $price, $time);
        return $stmt->execute();
    }

    /* ---------------- UTILITIES ---------------- */
    public static function countByUser($conn, $userId) {
        $sql = "SELECT COUNT(*) AS cnt FROM tickets WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            return 0;
        }
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? (int)$result->fetch_assoc()['cnt'] : 0;
    }
}