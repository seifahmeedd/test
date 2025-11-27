<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Events</title>
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
          <div class="muted">Browse Events</div>
        </div>
      </a>
      <nav>
        <a href="index.php" class="btn">Home</a>
        <a href="events.php" class="btn active">Events</a>
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
          <a href="events.php" class="btn active">Events</a>
          <a href="login.php" class="btn">Login</a>
          <a href="register.php" class="btn">Register</a>
        </aside>

        <!-- Event List -->
        <div>
          <div class="card">
            <h2>Upcoming Events</h2>
            <p class="muted">Browse and book your favorite events 🎉</p>
          </div>

          <!-- JS will populate this grid -->
          <div class="grid"></div>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <footer>
      Eventify &copy; 2025 - Event Booking Platform
    </footer>
  </div>

  <!-- Call JS after DOM is ready -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      renderEvents();
    });
  </script>
</body>
</html>