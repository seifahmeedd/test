<?php
session_start();
include 'db.php';

// Require admin role
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] ?? 'user') !== 'admin') {
    header('Location: login.php');
    exit;
}

$error = "";
$success = "";

// Handle Add User form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $role     = $_POST['role'];
    $status   = $_POST['status'];

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultCheck = $stmt->get_result();

    if ($resultCheck && $resultCheck->num_rows > 0) {
        $error = "Email already registered.";
    } else {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $stmtInsert = $conn->prepare("INSERT INTO users (name, email, password, role, status) VALUES (?, ?, ?, ?, ?)");
        $stmtInsert->bind_param("sssss", $name, $email, $hashedPassword, $role, $status);

        if ($stmtInsert->execute()) {
            $success = "User added successfully!";
            // Refresh to show new user in table
            header("Location: adminUsers.php?msg=created");
            exit;
        } else {
            $error = "Error creating user.";
        }
    }
}

// Fetch all users
$users = [];
$sql = "SELECT id, name, email, role, status FROM users ORDER BY id ASC";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Users</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="app">
    <!-- Header -->
    <header>
      <a href="index.php" class="eb-logo">
        <img src="logo/logo.png" alt="Eventify logo" class="logo-img" />
      </a>
      <nav>
        <a href="logout.php" class="btn">Logout</a>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="container">
      <section class="dash">
        <!-- Sidebar -->
        <aside class="sidenav card">
          <a href="admin.php" class="btn">Overview</a>
          <a href="adminUsers.php" class="btn active">Users</a>
          <a href="adminEvents.php" class="btn">Events</a>
          <a href="adminLogs.php" class="btn">Logs</a>
        </aside>

        <div>
          <div class="card">
            <h2>Manage Users</h2>
            <?php if (!empty($error)): ?>
              <p class="error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <?php if (!empty($_GET['msg']) && $_GET['msg'] === 'created'): ?>
              <p class="success">User added successfully!</p>
            <?php endif; ?>
          </div>

          <!-- Users Table -->
          <div class="card">
            <table>
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($users)): ?>
                  <?php foreach ($users as $user): ?>
                    <tr>
                      <td><?= $user['id'] ?></td>
                      <td><?= htmlspecialchars($user['name']) ?></td>
                      <td><?= htmlspecialchars($user['email']) ?></td>
                      <td><?= htmlspecialchars(ucfirst($user['role'])) ?></td>
                      <td><span class="status <?= htmlspecialchars($user['status']) ?>"><?= htmlspecialchars($user['status']) ?></span></td>
                      <td>
                        <a href="editUser.php?id=<?= $user['id'] ?>" class="btn small">Edit</a>
                        <a href="deleteUser.php?id=<?= $user['id'] ?>" class="btn small danger" onclick="return confirm('Delete this user?');">Delete</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr><td colspan="6">No users found.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

          <!-- Add User Form -->
          <div class="card">
            <h3>Add New User</h3>
            <form action="adminUsers.php" method="POST" class="user-form">
              <div class="form-grid">
                <div>
                  <label>Full Name</label>
                  <input type="text" name="name" required placeholder="Enter full name" />
                </div>
                <div>
                  <label>Email</label>
                  <input type="email" name="email" required placeholder="Enter email" />
                </div>
                <div>
                  <label>Password</label>
                  <input type="password" name="password" required placeholder="Enter password" />
                </div>
                <div>
                  <label>Role</label>
                  <select name="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                  </select>
                </div>
                <div>
                  <label>Status</label>
                  <select name="status">
                    <option value="active">Active</option>
                    <option value="suspended">Suspended</option>
                  </select>
                </div>
              </div>
              <button class="btn primary" type="submit">Add User</button>
            </form>
          </div>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <footer>
      Eventify &copy; 2025
    </footer>
  </div>
</body>
</html>