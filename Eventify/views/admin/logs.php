<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Logs</title>
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
          <a href="admin.php?action=users" class="btn">Users</a>
          <a href="admin.php?action=events" class="btn">Events</a>
          <a href="admin.php?action=logs" class="btn active">Logs</a>
        </aside>

        <!-- Logs Table -->
        <div>
          <div class="card">
            <h2>System Logs</h2>
            <p class="muted">Track admin actions and system events</p>
          </div>

          <!-- Alerts -->
          <?php if (isset($_GET['msg'])): ?>
            <div class="alert <?= ($_GET['msg'] === 'error' ? 'error' : 'success') ?>">
              <?php if ($_GET['msg'] === 'cleared'): ?>
                Logs cleared successfully.
              <?php elseif ($_GET['msg'] === 'notfound'): ?>
                Log not found.
              <?php elseif ($_GET['msg'] === 'error'): ?>
                An error occurred while processing logs.
              <?php endif; ?>
            </div>
          <?php endif; ?>

          <div class="card">
            <table>
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Action</th>
                  <th scope="col">User ID</th>
                  <th scope="col">Timestamp</th>
                  <th scope="col">Details</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($logs)): ?>
                  <tr><td colspan="5" class="center muted">No logs found.</td></tr>
                <?php else: ?>
                  <?php foreach ($logs as $log): ?>
                    <tr>
                      <td>#<?= htmlspecialchars($log['id']) ?></td>
                      <td><?= htmlspecialchars($log['action']) ?></td>
                      <td><?= htmlspecialchars($log['user_id']) ?></td>
                      <td><?= htmlspecialchars($log['created_at']) ?></td>
                      <td><?= htmlspecialchars($log['details']) ?></td>
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