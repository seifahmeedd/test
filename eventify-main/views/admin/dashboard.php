<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
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
          <a href="admin.php" class="btn active">Overview</a>
          <a href="adminUsers.php" class="btn">Users</a>
          <a href="adminEvents.php" class="btn">Events</a>
          <a href="adminLogs.php" class="btn">Logs</a>
        </aside>

        <!-- Dashboard Body -->
        <div>
          <!-- Page Title -->
          <div class="card">
            <h2>Admin Overview</h2>
          </div>

          <!-- Summary Cards -->
          <div class="summary-cards grid">
            <div class="card center">
              <h3><?= $totalUsers ?></h3>
              <p class="muted">Total Users</p>
            </div>
            <div class="card center">
              <h3><?= $totalTickets ?></h3>
              <p class="muted">Tickets Sold</p>
            </div>
            <div class="card center">
              <h3>$<?= $totalRevenue ?></h3>
              <p class="muted">Revenue</p>
            </div>
            <div class="card center">
              <h3><?= $activeEvents ?></h3>
              <p class="muted">Active Events</p>
            </div>
          </div>

          <!-- Events Table -->
          <div class="card">
            <h3>Events</h3>
            <table>
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Title</th>
                  <th scope="col">Category</th>
                  <th scope="col">Date</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($events)): ?>
                  <tr><td colspan="5" class="center muted">No events found.</td></tr>
                <?php else: ?>
                  <?php foreach ($events as $event): ?>
                    <tr>
                      <td>#<?= $event['id'] ?></td>
                      <td><?= htmlspecialchars($event['title']) ?></td>
                      <td><?= htmlspecialchars($event['category']) ?></td>
                      <td><?= $event['date'] ?></td>
                      <td>
                        <span class="status <?= $event['status'] === 'active' ? 'active' : 'danger' ?>">
                          <?= ucfirst($event['status']) ?>
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