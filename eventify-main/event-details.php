<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Event Details</title>
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
          <div class="muted">Event Details</div>
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
      <section class="hero">
        <!-- Left: Event Info -->
        <div class="left">
          <h2><!-- JS will inject event title --></h2>
          <p class="muted"><!-- JS will inject venue + date --></p>
          <p>Lorem ipsum description placeholder for the event. This will be replaced dynamically.</p>
        </div>

        <!-- Right: Booking Info -->
        <div class="right card">
          <h2><!-- JS will inject price --></h2>
          <button class="btn primary" onclick="addToCart(new URLSearchParams(window.location.search).get('id'))">
            Add to Cart
          </button>
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
      renderEventDetails();
    });
  </script>
</body>
</html>