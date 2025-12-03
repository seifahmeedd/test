<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Your Ticket</title>
  <link rel="stylesheet" href="public/style.css">
  <script src="public/app.js"></script>
</head>
<body>
  <div class="app">
    <!-- Header -->
    <header>
      <a href="index.php" class="eb-logo">
        <img src="public/logo/logo.png" alt="Eventify logo" class="logo-img">
        <div>
          <div class="brand">Eventify</div>
          <div class="muted">Your Ticket</div>
        </div>
      </a>
      <nav>
        <?php if (isset($_SESSION['user_id'])): ?>
          <a href="dashboard.php" class="btn">Dashboard</a>
          <a href="users.php?action=logout" class="btn">Logout</a>
        <?php else: ?>
          <a href="users.php?action=login" class="btn">Login</a>
          <a href="users.php?action=register" class="btn primary">Register</a>
        <?php endif; ?>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="container">
      <section class="dash">
        <!-- Sidebar Navigation -->
        <aside class="sidenav card">
          <a href="../index.php" class="btn">Home</a>
          <a href="../events.php" class="btn">Events</a>
          <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="../login.php" class="btn">Login</a>
            <a href="../register.php" class="btn">Register</a>
          <?php endif; ?>
        </aside>

        <!-- Ticket Details -->
        <div>
          <?php if (!empty($ticket)): ?>
            <div class="card ticket-card center">
              <div class="emoji-hero">🎟️</div>
              <h2 id="ticketEvent"><?= htmlspecialchars($ticket['event']) ?></h2>
              <p class="muted" id="ticketVenueDate">
                <?= htmlspecialchars($ticket['venue']) ?> • <?= htmlspecialchars($ticket['date']) ?>
              </p>

              <div class="ticket-info" id="ticketInfo">
                <div><strong>Seat:</strong> <?= htmlspecialchars($ticket['seat']) ?></div>
                <div><strong>Time:</strong> <?= htmlspecialchars($ticket['time']) ?></div>
                <div><strong>Price:</strong> $<?= number_format($ticket['price'], 2) ?></div>
                <div><strong>Entry Code:</strong> <?= htmlspecialchars($ticket['code']) ?></div>
              </div>

              <div class="qr-area">
                <img id="ticketQR"
                     src="https://api.qrserver.com/v1/create-qr-code/?data=<?= urlencode($ticket['code']) ?>&size=130x130"
                     alt="QR Code for <?= htmlspecialchars($ticket['code']) ?>" aria-label="Ticket QR Code" />
                <p class="muted">Scan this at the gate</p>
              </div>

              <a href="tickets.php?action=download&id=<?= $ticket['id'] ?>" 
                 class="btn primary" id="downloadBtn" aria-label="Download Ticket PDF">
                 ⬇️ Download Ticket (PDF)
              </a>
            </div>
          <?php else: ?>
            <div class="card center">
              <div class="alert error">No Ticket Found</div>
              <p class="muted">Sorry, we couldn’t find your ticket. Please check your dashboard.</p>
              <a href="../dashboard.php" class="btn primary">Go to Dashboard</a>
            </div>
          <?php endif; ?>
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