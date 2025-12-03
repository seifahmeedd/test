<?php
class Ticket {

    /* ---------------- READ ---------------- */

    // Get ticket by ID
    public static function getById($conn, $id) {
        $sql = "SELECT * FROM tickets WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Ticket::getById prepare failed: " . $conn->error);
            return null;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_assoc() : null;
    }

    // Get tickets by user (with event info)
    public static function getByUserId($conn, $userId) {
        $sql = "SELECT t.*, e.title, e.date, e.venue 
                FROM tickets t
                JOIN events e ON t.event_id = e.id
                WHERE t.user_id = ?
                ORDER BY e.date ASC";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Ticket::getByUserId prepare failed: " . $conn->error);
            return [];
        }
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Get all tickets for a user (simple version)
    public static function allByUser($conn, $userId) {
        $sql = "SELECT * FROM tickets WHERE user_id = ? ORDER BY created_at ASC";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Ticket::allByUser prepare failed: " . $conn->error);
            return [];
        }
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Get tickets by order
    public static function getByOrderId($conn, $orderId) {
        $sql = "SELECT t.*, e.title, e.date, e.venue 
                FROM tickets t
                JOIN events e ON t.event_id = e.id
                WHERE t.order_id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Ticket::getByOrderId prepare failed: " . $conn->error);
            return [];
        }
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    /* ---------------- PURCHASE ---------------- */

    public static function purchase($conn, $eventId, $userId, $quantity) {
        // Fetch event price
        $sqlEvent = "SELECT price FROM events WHERE id = ?";
        $stmtEvent = $conn->prepare($sqlEvent);
        if (!$stmtEvent) {
            error_log("Ticket::purchase event prepare failed: " . $conn->error);
            return false;
        }
        $stmtEvent->bind_param("i", $eventId);
        $stmtEvent->execute();
        $event = $stmtEvent->get_result()->fetch_assoc();

        if (!$event) return false;
        $price = $event['price'];

        // Create order
        $sqlOrder = "INSERT INTO orders (user_id, event_id, total, status, created_at) 
                     VALUES (?, ?, ?, 'paid', NOW())";
        $stmtOrder = $conn->prepare($sqlOrder);
        if (!$stmtOrder) {
            error_log("Ticket::purchase order prepare failed: " . $conn->error);
            return false;
        }
        $total = $price * $quantity;
        $stmtOrder->bind_param("iid", $userId, $eventId, $total);

        if (!$stmtOrder->execute()) return false;
        $orderId = $stmtOrder->insert_id;

        // Insert tickets
        $sqlTicket = "INSERT INTO tickets (order_id, user_id, event_id, seat, code, price, time, created_at) 
                      VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
        $stmtTicket = $conn->prepare($sqlTicket);
        if (!$stmtTicket) {
            error_log("Ticket::purchase ticket prepare failed: " . $conn->error);
            return false;
        }

        for ($i = 1; $i <= $quantity; $i++) {
            $seat = "S" . $i; // simple seat assignment
            $code = uniqid("TKT"); // unique ticket code
            $stmtTicket->bind_param("iiissd", $orderId, $userId, $eventId, $seat, $code, $price);
            if (!$stmtTicket->execute()) return false;
        }

        return true;
    }

    /* ---------------- CREATE ---------------- */
    public static function create($conn, $orderId, $userId, $eventId, $seat, $code, $price, $time) {
        $sql = "INSERT INTO tickets (order_id, user_id, event_id, seat, code, price, time, created_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Ticket::create prepare failed: " . $conn->error);
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
            error_log("Ticket::countByUser prepare failed: " . $conn->error);
            return 0;
        }
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? (int)$result->fetch_assoc()['cnt'] : 0;
    }
}