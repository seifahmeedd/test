<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
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
          <a href="admin.php?action=dashboard" class="btn active">Overview</a>
          <a href="admin.php?action=users" class="btn">Users</a>
          <a href="admin.php?action=events" class="btn">Events</a>
          <a href="admin.php?action=logs" class="btn">Logs</a>
        </aside>

        <!-- Dashboard Body -->
        <div>
          <!-- Page Title -->
          <div class="card">
            <h2>Admin Overview</h2>
          </div>

          <!-- Alerts -->
          <?php if (isset($_GET['msg'])): ?>
            <div class="alert <?= ($_GET['msg'] === 'error' ? 'error' : 'success') ?>">
              <?php if ($_GET['msg'] === 'added'): ?>
                Event added successfully.
              <?php elseif ($_GET['msg'] === 'updated'): ?>
                Event updated successfully.
              <?php elseif ($_GET['msg'] === 'deleted'): ?>
                Event deleted successfully.
              <?php elseif ($_GET['msg'] === 'notfound'): ?>
                Event not found.
              <?php elseif ($_GET['msg'] === 'error'): ?>
                An error occurred.
              <?php endif; ?>
            </div>
          <?php endif; ?>

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
                       <span class="tag 
                        <?= $event['status'] === 'active' ? 'success' : 
                           ($event['status'] === 'cancelled' ? 'danger' : 
                           ($event['status'] === 'sold_out' ? 'warning' : '')) ?>">
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