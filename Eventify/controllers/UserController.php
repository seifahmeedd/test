<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Ticket.php'; // Needed for dashboard tickets

class UserController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /* ---------------- AUTH ---------------- */
    public function showLogin($error = "") {
        include __DIR__ . '/../views/users/login.php';
    }

    public function showRegister($error = "") {
        include __DIR__ . '/../views/users/register.php';
    }

    public function login($email, $password) {
        $user = User::login($this->conn, $email, $password);

        if ($user) {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header("Location: admin.php?action=dashboard");
            } else {
                header("Location: users.php?action=dashboard"); // ✅ route through users.php
            }
            exit;
        } else {
            $error = "Invalid email or password.";
            $this->showLogin($error);
        }
    }

    public function register($username, $email, $password) {
        if (User::register($this->conn, $username, $email, $password)) {
            header("Location: users.php?action=login&msg=registered"); // ✅ route through users.php
            exit;
        } else {
            $error = "Registration failed. Try again.";
            $this->showRegister($error);
        }
    }

    public function dashboard() {
        $userId = $_SESSION['user_id'] ?? null;

        if (!$userId) {
            header("Location: users.php?action=login");
            exit;
        }

        // Fetch user info
        $user = User::getById($this->conn, $userId);

        // Fetch tickets
        $tickets = Ticket::getByUserId($this->conn, $userId);
        $ticketCount = count($tickets);

        include __DIR__ . '/../views/users/dashboard.php';
    }

    /* ---------------- ADMIN: USERS ---------------- */
    public function listUsers() {
        $users = User::all($this->conn);
        include __DIR__ . '/../views/admin/users.php';
    }

    public function addUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name     = trim($_POST['name']);
            $email    = trim($_POST['email']);
            $password = $_POST['password'];
            $role     = $_POST['role'];
            $status   = $_POST['status'];

            if (User::create($this->conn, $name, $email, $password, $role, $status)) {
                header("Location: admin.php?action=users&msg=created");
                exit;
            } else {
                $error = "Error creating user.";
            }
        }
        include __DIR__ . '/../views/admin/addUser.php';
    }

    public function editUser($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name   = trim($_POST['name']);
            $email  = trim($_POST['email']);
            $role   = $_POST['role'];
            $status = $_POST['status'];

            if (User::update($this->conn, $id, $name, $email, $role, $status)) {
                header("Location: admin.php?action=users&msg=updated");
                exit;
            } else {
                $error = "Error updating user.";
                $user = User::getById($this->conn, $id);
            }
        } else {
            $user = User::getById($this->conn, $id);
            if (!$user) {
                // ✅ No error.php → redirect with msg
                header("Location: admin.php?action=users&msg=notfound");
                exit;
            }
        }
        include __DIR__ . '/../views/admin/editUser.php';
    }

    public function deleteUser($id) {
        if (User::delete($this->conn, $id)) {
            header("Location: admin.php?action=users&msg=deleted");
            exit;
        } else {
            header("Location: admin.php?action=users&msg=deleteerror"); // ✅ no error.php
            exit;
        }
    }

    public function index() {
        $users = User::all($this->conn);
        include __DIR__ . '/../views/admin/users.php';
    }
}