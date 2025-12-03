<?php
class Event {

    /* ---------------- PUBLIC FUNCTIONS ---------------- */

    // Get all events (for homepage, events list)
    public static function all($conn) {
        $sql = "SELECT id, title, description, date, price, category, venue, capacity, status 
                FROM events 
                ORDER BY id ASC";
        $result = $conn->query($sql);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Get single event by ID (for event-details.php)
    public static function getById($conn, $id) {
        $sql = "SELECT id, title, description, venue, date, time, category, capacity, price, status 
                FROM events WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Event::getById prepare failed: " . $conn->error);
            return null;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_assoc() : null;
    }

    /* ---------------- ADMIN FUNCTIONS ---------------- */

    // Create new event
    public static function create($conn, $title, $description, $venue, $date, $time, $category, $capacity, $price, $status) {
        $sql = "INSERT INTO events (title, description, venue, date, time, category, capacity, price, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Event::create prepare failed: " . $conn->error);
            return false;
        }
        $stmt->bind_param("ssssssids", $title, $description, $venue, $date, $time, $category, $capacity, $price, $status);
        return $stmt->execute();
    }

    // Update existing event
    public static function update($conn, $id, $title, $description, $venue, $date, $time, $category, $capacity, $price, $status) {
        $sql = "UPDATE events 
                SET title = ?, description = ?, venue = ?, date = ?, time = ?, category = ?, capacity = ?, price = ?, status = ? 
                WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Event::update prepare failed: " . $conn->error);
            return false;
        }
        $stmt->bind_param("ssssssidsi", $title, $description, $venue, $date, $time, $category, $capacity, $price, $status, $id);
        return $stmt->execute();
    }

    // Delete event
    public static function delete($conn, $id) {
        $sql = "DELETE FROM events WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Event::delete prepare failed: " . $conn->error);
            return false;
        }
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    /* ---------------- EXTRA UTILITIES ---------------- */

    // Count all events
    public static function count($conn) {
        $sql = "SELECT COUNT(*) AS cnt FROM events";
        $result = $conn->query($sql);
        return $result ? (int)$result->fetch_assoc()['cnt'] : 0;
    }

    // Get active events
    public static function getActiveEvents($conn) {
        $sql = "SELECT id, title, description, venue, date, time, category, capacity, price, status 
                FROM events 
                WHERE status = 'active' 
                ORDER BY date ASC";
        $result = $conn->query($sql);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Search events by keyword (for homepage search bar)
    public static function search($conn, $keyword) {
        $sql = "SELECT id, title, description, venue, date, time, category, capacity, price, status 
                FROM events 
                WHERE title LIKE ? OR description LIKE ? OR category LIKE ? 
                ORDER BY date ASC";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Event::search prepare failed: " . $conn->error);
            return [];
        }
        $like = "%" . $keyword . "%";
        $stmt->bind_param("sss", $like, $like, $like);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }
}