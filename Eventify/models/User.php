<?php
class User {

    /* ---------------- AUTH ---------------- */

    // Register a new user (default role=user, status=active)
    public static function register($conn, $username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, password, role, status) VALUES (?, ?, ?, 'user', 'active')";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("User::register prepare failed: " . $conn->error);
            return false;
        }
        $stmt->bind_param("sss", $username, $email, $hashedPassword);
        return $stmt->execute();
    }

    // Login user by email + password
    public static function login($conn, $email, $password) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("User::login prepare failed: " . $conn->error);
            return false;
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result ? $result->fetch_assoc() : null;

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    // Count all users
    public static function count($conn) {
        $sql = "SELECT COUNT(*) AS total_users FROM users";
        $result = $conn->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            return (int)($row['total_users'] ?? 0);
        }
        return 0;
    }

    /* ---------------- ADMIN FUNCTIONS ---------------- */

    // Create new user (admin)
    public static function create($conn, $name, $email, $password, $role, $status) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, password, role, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("User::create prepare failed: " . $conn->error);
            return false;
        }
        $stmt->bind_param("sssss", $name, $email, $hashedPassword, $role, $status);
        return $stmt->execute();
    }

    // Update existing user
    public static function update($conn, $id, $name, $email, $role, $status) {
        $sql = "UPDATE users SET name = ?, email = ?, role = ?, status = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("User::update prepare failed: " . $conn->error);
            return false;
        }
        $stmt->bind_param("ssssi", $name, $email, $role, $status, $id);
        return $stmt->execute();
    }

    // Delete user
    public static function delete($conn, $id) {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("User::delete prepare failed: " . $conn->error);
            return false;
        }
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Get user by ID
    public static function getById($conn, $id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("User::getById prepare failed: " . $conn->error);
            return null;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_assoc() : null;
    }

    // Get all users
    public static function all($conn) {
        $sql = "SELECT * FROM users ORDER BY created_at ASC";
        $result = $conn->query($sql);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    /* ---------------- OPTIONAL HELPERS ---------------- */


    
    // Find user by email
    public static function findByEmail($conn, $email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("User::findByEmail prepare failed: " . $conn->error);
            return null;
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_assoc() : null;
    }

    // Update user password
    public static function updatePassword($conn, $id, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("User::updatePassword prepare failed: " . $conn->error);
            return false;
        }
        $stmt->bind_param("si", $hashedPassword, $id);
        return $stmt->execute();
    }

    /* ---------------- EXTRA UTILITIES ---------------- */

    // Get all active users
    public static function getActiveUsers($conn) {
        $sql = "SELECT * FROM users WHERE status = 'active' ORDER BY created_at ASC";
        $result = $conn->query($sql);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Count users by role
    public static function countByRole($conn, $role) {
        $sql = "SELECT COUNT(*) AS cnt FROM users WHERE role = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("User::countByRole prepare failed: " . $conn->error);
            return 0;
        }
        $stmt->bind_param("s", $role);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? (int)$result->fetch_assoc()['cnt'] : 0;
    }
}