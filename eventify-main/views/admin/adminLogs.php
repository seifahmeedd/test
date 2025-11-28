<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Logs</title>
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
          <a href="adminUsers.php" class="btn">Users</a>
          <a href="adminEvents.php" class="btn">Events</a>
          <a href="adminLogs.php" class="btn active">Logs</a>
        </aside>

        <!-- Dashboard Body -->
        <div>
          <!-- Page Title -->
          <div class="card">
            <h2>System Logs</h2>
          </div>

          <!-- Summary Cards -->
          <div class="summary-cards grid">
            <div class="card center">
              <h3><?= count($logs) ?></h3>
              <p class="muted">Total Logs</p>
            </div>
            <div class="card center">
              <h3><?= $todayCount ?></h3>
              <p class="muted">Actions Today</p>
            </div>
            <div class="card center">
              <h3><?= $errorCount ?></h3>
              <p class="muted">Errors</p>
            </div>
          </div>

          <!-- Filters -->
          <div class="card">
            <h3>Filter Logs</h3>
            <div class="row">
              <input type="text" id="filterAction" placeholder="Filter by action or user..." />
              <input type="date" id="filterDate" />
              <button id="clearFilters" class="btn primary">Clear</button>
            </div>
          </div>

          <!-- Logs Table -->
          <div class="card">
            <table id="logsTable">
              <thead>
                <tr>
                  <th scope="col">Log ID</th>
                  <th scope="col">User</th>
                  <th scope="col">Action</th>
                  <th scope="col">Date</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($logs)): ?>
                  <tr><td colspan="5" class="center muted">No logs found.</td></tr>
                <?php else: ?>
                  <?php foreach ($logs as $log): ?>
                    <tr>
                      <td>#<?= $log['id'] ?></td>
                      <td><?= htmlspecialchars($log['username']) ?></td>
                      <td><?= htmlspecialchars($log['action']) ?></td>
                      <td><?= $log['timestamp'] ?></td>
                      <td>
                        <span class="status 
                          <?= $log['status'] === 'success' ? 'active' : 
                              ($log['status'] === 'warning' ? 'warning' : 'danger') ?>">
                          <?= ucfirst($log['status']) ?>
                        </span>
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