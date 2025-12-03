<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Users</title>
  <link rel="stylesheet" href="public/style.css">
  <script src="public/app.js"></script>
</head>
<body>
  <div class="app">
    <!-- Header -->
    <header>
      <a href="admin.php?action=dashboard" class="eb-logo">
        <img src="public/logo/logo.png" alt="Eventify logo" class="logo-img">
      </a>
      <nav>
        <a href="users.php?action=logout" class="btn">Logout</a>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="container">
      <section class="dash">
        <!-- Sidebar Navigation -->
        <aside class="sidenav card">
          <a href="admin.php?action=dashboard" class="btn">Overview</a>
          <a href="admin.php?action=users" class="btn active">Users</a>
          <a href="admin.php?action=events" class="btn">Events</a>
          <a href="admin.php?action=logs" class="btn">Logs</a>
        </aside>

        <!-- Dashboard Body -->
        <div>
          <!-- Page Title -->
          <div class="card">
            <h2>Manage Users</h2>
            <a href="admin.php?action=addUser" class="btn primary">+ Add New User</a>
          </div>

          <!-- Alerts -->
          <?php if (isset($_GET['msg'])): ?>
            <div class="alert <?= ($_GET['msg'] === 'error' ? 'error' : 'success') ?>">
              <?php if ($_GET['msg'] === 'created'): ?>
                User created successfully.
              <?php elseif ($_GET['msg'] === 'updated'): ?>
                User updated successfully.
              <?php elseif ($_GET['msg'] === 'deleted'): ?>
                User deleted successfully.
              <?php elseif ($_GET['msg'] === 'notfound'): ?>
                User not found.
              <?php elseif ($_GET['msg'] === 'deleteerror'): ?>
                Error deleting user.
              <?php endif; ?>
            </div>
          <?php endif; ?>

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
                        <span class="tag 
  <?= $user['status'] === 'active' ? 'success' : 
     ($user['status'] === 'inactive' ? 'muted' : 
     ($user['status'] === 'suspended' ? 'warning' : 
     ($user['status'] === 'banned' ? 'danger' : ''))) ?>">
  <?= ucfirst($user['status']) ?>
</span>
                      </td>
                      <td>
                        <a href="admin.php?action=editUser&id=<?= $user['id'] ?>" class="btn">Edit</a>
                        <a href="admin.php?action=deleteUser&id=<?= $user['id'] ?>"
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