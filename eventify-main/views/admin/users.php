<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Users</title>
  <link rel="stylesheet" href="style.css">
  <script src="app.js"></script>
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
        <!-- Sidebar Navigation -->
        <aside class="sidenav card">
          <a href="admin.php" class="btn">Overview</a>
          <a href="adminUsers.php" class="btn active">Users</a>
          <a href="adminEvents.php" class="btn">Events</a>
          <a href="adminLogs.php" class="btn">Logs</a>
        </aside>

        <!-- Dashboard Body -->
        <div>
          <!-- Page Title -->
          <div class="card">
            <h2>Manage Users</h2>
          </div>

          <!-- Add User Button -->
          <div class="card">
            <a href="adminAddUser.php" class="btn primary">+ Add New User</a>
          </div>

          <!-- Users Table -->
          <div class="card">
            <h3>Users</h3>
            <table>
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Role</th>
                  <th scope="col">Status</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($users)): ?>
                  <tr><td colspan="6" class="center muted">No users found.</td></tr>
                <?php else: ?>
                  <?php foreach ($users as $user): ?>
                    <tr>
                      <td>#<?= $user['id'] ?></td>
                      <td><?= htmlspecialchars($user['name']) ?></td>
                      <td><?= htmlspecialchars($user['email']) ?></td>
                      <td><?= ucfirst($user['role']) ?></td>
                      <td>
                        <span class="status <?= $user['status'] === 'active' ? 'active' : 'danger' ?>">
                          <?= ucfirst($user['status']) ?>
                        </span>
                      </td>
                      <td>
                        <a href="adminEditUser.php?id=<?= $user['id'] ?>" class="btn">Edit</a>
                        <a href="adminDeleteUser.php?id=<?= $user['id'] ?>" 
                           class="btn danger" 
                           onclick="return confirm('Are you sure you want to delete this user?');">
                          Delete
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
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