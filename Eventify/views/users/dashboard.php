<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="public/style.css">
  <script src="public/app.js"></script>
</head>
<body>
  <div class="app">
    <!-- Header -->
    <header>
      <a href="users.php?action=dashboard" class="eb-logo">
        <img src="public/logo/logo.png" alt="Eventify logo" class="logo-img">
      </a>
      <nav>
        <?php if (isset($_SESSION['user_id'])): ?>
          <a href="users.php?action=logout" class="btn">Logout</a>
        <?php endif; ?>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="container">
      <section class="dash">
        <!-- Sidebar Navigation -->
        <aside class="sidenav card">
          <a href="events.php?action=list" class="btn">Events</a>
        </aside>

        <!-- Dashboard Body -->
        <div>
          <!-- Feedback Messages -->
          <?php if (!empty($error)): ?>
            <div class="alert error"><?= htmlspecialchars($error) ?></div>
          <?php endif; ?>
          <?php if (!empty($success)): ?>
            <div class="alert success"><?= htmlspecialchars($success) ?></div>
          <?php endif; ?>

          <!-- Welcome Card -->
          <div class="card">
            <h2>Welcome, <?= htmlspecialchars($user['name']) ?></h2>
            <p class="muted">Overview of your account activity.</p>
          </div>

          <!-- Summary Cards -->
          <div class="summary-cards grid">
            <div class="card center">
              <h3><?= $ticketCount ?></h3>
              <p class="muted">Tickets</p>
            </div>
            <div class="card center">
              <p class="muted">Orders</p>
            </div>
            <div class="card center">
              <p class="muted">Total Spent</p>
            </div>
          </div>

          <!-- Recent Tickets -->
          <div class="card">
            <h3>Recent Tickets</h3>
            <table id="ticketsTable" aria-label="Recent Tickets">
              <thead>
                <tr>
                  <th scope="col">Event</th>
                  <th scope="col">Date</th>
                  <th scope="col">Seat</th>
                  <th scope="col">Code</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($tickets)): ?>
                  <tr><td colspan="4" class="center muted">No tickets found.</td></tr>
                <?php else: ?>
                  <?php foreach ($tickets as $t): ?>
                    <tr>
                      <td><?= htmlspecialchars($t['event']) ?></td>
                      <td><?= htmlspecialchars($t['date']) ?></td>
                      <td><?= htmlspecialchars($t['seat']) ?></td>
                      <td><?= htmlspecialchars($t['code']) ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

          <!-- Recent Orders -->
          <div class="card">
            <h3>Recent Orders</h3>
            <table id="ordersTable" aria-label="Recent Orders">
              <thead>
                <tr>
                  <th scope="col">Order ID</th>
                  <th scope="col">Event</th>
                  <th scope="col">Date</th>
                  <th scope="col">Total</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($orders)): ?>
                  <tr><td colspan="5" class="center muted">No orders found.</td></tr>
                <?php else: ?>
                  <?php foreach ($orders as $o): ?>
                    <tr>
                      <td>#<?= $o['id'] ?></td>
                      <td><?= htmlspecialchars($o['event']) ?></td>
                      <td><?= htmlspecialchars($o['date']) ?></td>
                      <td>$<?= number_format($o['total'], 2) ?></td>
                      <td>
                        <span class="tag <?= $o['status'] === 'paid' ? 'success' : 'danger' ?>">
                          <?= ucfirst($o['status']) ?>
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