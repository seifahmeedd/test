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
        <div>
          <div class="brand">Eventify</div>
          <div class="muted">Dashboard</div>
        </div>
      </a>
      <nav>
        <a href="index.php" class="btn">Home</a>
        <a href="events.php" class="btn">Events</a>
        <a href="dashboard.php" class="btn active">Dashboard</a>
        <a href="login.php" class="btn">Login</a>
        <a href="register.php" class="btn primary">Register</a>
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
            <h2>Welcome, <span id="userName">Guest</span></h2>
            <p class="muted">Manage your account and view your activity.</p>
          </div>

          <!-- Tickets Section -->
          <div id="tickets" class="dashboard-section card" style="display:none;">
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
              <tbody id="ticketsTable">
                <!-- JS will inject tickets here -->
              </tbody>
            </table>
          </div>

          <!-- Orders Section -->
          <div id="orders" class="dashboard-section card" style="display:none;">
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
              <tbody id="ordersTable">
                <!-- JS will inject orders here -->
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <footer>
      Eventify &copy; 2025 - Dashboard
    </footer>
  </div>
</body>
</html>