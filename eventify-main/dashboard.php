<?php
session_start();
include 'db.php';

// Require login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch user info
$userName = "Guest";
$sqlUser = "SELECT name FROM users WHERE id=?";
$stmtUser = $conn->prepare($sqlUser);
$stmtUser->bind_param("i", $_SESSION['user_id']);
$stmtUser->execute();
$resUser = $stmtUser->get_result();
if ($rowUser = $resUser->fetch_assoc()) {
    $userName = htmlspecialchars($rowUser['name']);
}

// Fetch tickets
$tickets = [];
$sqlTickets = "SELECT e.title, e.date, t.seat, t.code 
               FROM tickets t 
               JOIN events e ON t.event_id = e.id 
               WHERE t.user_id=?";
$stmtTickets = $conn->prepare($sqlTickets);
$stmtTickets->bind_param("i", $_SESSION['user_id']);
$stmtTickets->execute();
$resTickets = $stmtTickets->get_result();
while ($row = $resTickets->fetch_assoc()) {
    $tickets[] = $row;
}

// Fetch orders
$orders = [];
$sqlOrders = "SELECT o.order_number, e.title, e.date, o.total, o.status 
              FROM orders o 
              JOIN events e ON o.event_id = e.id 
              WHERE o.user_id=?";
$stmtOrders = $conn->prepare($sqlOrders);
$stmtOrders->bind_param("i", $_SESSION['user_id']);
$stmtOrders->execute();
$resOrders = $stmtOrders->get_result();
while ($row = $resOrders->fetch_assoc()) {
    $orders[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css" />
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
        <a href="index.php" class="btn">Home</a>
        <a href="events.php" class="btn">Events</a>
        <a href="dashboard.php" class="btn active">Dashboard</a>
        <a href="logout.php" class="btn">Logout</a>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="container">
      <section class="dash">
        <!-- Sidebar Navigation -->
        <aside class="sidenav card">
          <a href="#profile" onclick="showSection('profile')" class="btn active">Profile</a>
          <a href="#tickets" onclick="showSection('tickets')" class="btn">My Tickets</a>
          <a href="#orders" onclick="showSection('orders')" class="btn">Orders</a>
        </aside>

        <!-- Dashboard Sections -->
        <div>
          <!-- Profile Section -->
          <div id="profile" class="dashboard-section active card welcome-banner">
            <h2>Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?></h2>
            <p class="muted">Manage your account and view your activity.</p>
          </div>

          <!-- Tickets Section -->
          <div id="tickets" class="dashboard-section card">
            <h2>My Tickets</h2>
            <table>
              <thead>
                <tr>
                  <th>Event</th>
                  <th>Date</th>
                  <th>Seat</th>
                  <th>Code</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($tickets)): ?>
                  <?php foreach ($tickets as $t): ?>
                    <tr>
                      <td><?= htmlspecialchars($t['title']) ?></td>
                      <td><?= htmlspecialchars($t['date']) ?></td>
                      <td><?= htmlspecialchars($t['seat']) ?></td>
                      <td><?= htmlspecialchars($t['code']) ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr><td colspan="4">No tickets found.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

          <!-- Orders Section -->
          <div id="orders" class="dashboard-section card">
            <h2>My Orders</h2>
            <table>
              <thead>
                <tr>
                  <th>Order #</th>
                  <th>Event</th>
                  <th>Date</th>
                  <th>Total</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($orders)): ?>
                  <?php foreach ($orders as $o): ?>
                    <tr>
                      <td><?= htmlspecialchars($o['order_number']) ?></td>
                      <td><?= htmlspecialchars($o['title']) ?></td>
                      <td><?= htmlspecialchars($o['date']) ?></td>
                      <td>$<?= number_format($o['total'], 2) ?></td>
                      <td><span class="status <?= htmlspecialchars($o['status']) ?>"><?= htmlspecialchars($o['status']) ?></span></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr><td colspan="5">No orders found.</td></tr>
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