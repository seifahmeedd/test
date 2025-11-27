<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ticket</title>
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
        <a href="index.php" class="btn">Home</a>
        <a href="events.php" class="btn">Events</a>
        <a href="dashboard.php" class="btn">Dashboard</a>
        <a href="login.php" class="btn">Login</a>
        <a href="register.php" class="btn primary">Register</a>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="container">
      <section class="dash">
        <!-- Sidebar Navigation -->
        <aside class="sidenav card">
          <a href="index.php" class="btn">Home</a>
          <a href="events.php" class="btn">Events</a>
          <a href="login.php" class="btn">Login</a>
          <a href="register.php" class="btn">Register</a>
        </aside>

        <!-- Ticket Details -->
        <div>
          <div class="card ticket-card center" style="flex-direction: column; text-align: center;">
            <div class="emoji-hero" style="font-size: 3rem;">🎟️</div>
            <h2 id="ticketEvent"><!-- JS injects event name --></h2>
            <p class="muted" id="ticketVenueDate"><!-- JS injects venue + date --></p>

            <div class="ticket-info" id="ticketInfo" style="margin: 20px 0;">
              <!-- JS injects seat, time, price, code -->
            </div>

            <div class="qr-area" style="margin: 20px 0;">
              <img id="ticketQR" src="" alt="QR Code" />
              <p class="muted">Scan this at the gate</p>
            </div>

            <button class="btn primary" id="downloadBtn">⬇️ Download Ticket (PDF)</button>
          </div>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <footer>
      Eventify &copy; 2025 - Ticketing System
    </footer>
  </div>
</body>
</html>