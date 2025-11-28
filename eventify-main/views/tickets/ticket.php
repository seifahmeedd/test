<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Your Ticket</title>
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
          <div class="muted">Your Ticket</div>
        </div>
      </a>
      <nav>
        <?php if (isset($_SESSION['user_id'])): ?>
          <a href="dashboard.php" class="btn">Dashboard</a>
          <a href="logout.php" class="btn">Logout</a>
        <?php else: ?>
          <a href="login.php" class="btn">Login</a>
          <a href="register.php" class="btn primary">Register</a>
        <?php endif; ?>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="container">
      <section class="dash">
        <!-- Sidebar Navigation -->
        <aside class="sidenav card">
          <a href="index.php" class="btn">Home</a>
          <a href="events.php" class="btn">Events</a>
          <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="login.php" class="btn">Login</a>
            <a href="register.php" class="btn">Register</a>
          <?php endif; ?>
        </aside>

        <!-- Ticket Details -->
        <div>
          <div class="card ticket-card center">
            <div class="emoji-hero">🎟️</div>
            <h2 id="ticketEvent">
              <?= !empty($ticket['event']) ? htmlspecialchars($ticket['event']) : '' ?>
            </h2>
            <p class="muted" id="ticketVenueDate">
              <?= !empty($ticket['venue']) && !empty($ticket['date']) 
                   ? htmlspecialchars($ticket['venue']) . ' • ' . htmlspecialchars($ticket['date']) 
                   : '' ?>
            </p>

            <div class="ticket-info" id="ticketInfo">
              <?php if (!empty($ticket)): ?>
                <div><strong>Seat:</strong> <?= htmlspecialchars($ticket['seat']) ?></div>
                <div><strong>Time:</strong> <?= htmlspecialchars($ticket['time']) ?></div>
                <div><strong>Price:</strong> $<?= number_format($ticket['price'], 2) ?></div>
                <div><strong>Entry Code:</strong> <?= htmlspecialchars($ticket['code']) ?></div>
              <?php endif; ?>
            </div>

            <div class="qr-area">
              <?php if (!empty($ticket['code'])): ?>
                <img id="ticketQR" 
                     src="https://api.qrserver.com/v1/create-qr-code/?data=<?= urlencode($ticket['code']) ?>&size=130x130" 
                     alt="QR Code for <?= htmlspecialchars($ticket['code']) ?>" />
              <?php endif; ?>
              <p class="muted">Scan this at the gate</p>
            </div>

            <button class="btn primary" id="downloadBtn">⬇️ Download Ticket (PDF)</button>
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