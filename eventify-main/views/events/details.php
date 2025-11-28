<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($event['title']) ?> - Event Details</title>
  <link rel="stylesheet" href="style.css">
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
      <section class="hero">
        <!-- Left: Event Info -->
        <div class="left">
          <h2><?= htmlspecialchars($event['title']) ?></h2>
          <p class="muted">
            <?= htmlspecialchars($event['venue']) ?> • 
            <?= htmlspecialchars($event['date']) ?> at <?= htmlspecialchars($event['time']) ?>
          </p>
          <p><?= nl2br(htmlspecialchars($event['description'])) ?></p>
          <p class="muted">Category: <?= htmlspecialchars($event['category']) ?></p>
          <p class="muted">Capacity: <?= htmlspecialchars($event['capacity']) ?> seats</p>
        </div>

        <!-- Right: Booking Info -->
        <div class="right card">
          <h2>$<?= number_format($event['price'], 2) ?></h2>
          <?php if (isset($_SESSION['user_id'])): ?>
            <a href="checkout.php?event_id=<?= $event['id'] ?>" class="btn primary">Reserve Tickets</a>
          <?php else: ?>
            <a href="register.php" class="btn">Register to Reserve</a>
          <?php endif; ?>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <footer>
      Eventify &copy; 2025 - Event Booking Platform
    </footer>
  </div>
</body>
</html>