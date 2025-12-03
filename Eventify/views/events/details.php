<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= !empty($event) ? htmlspecialchars($event['title']) . ' - Event Details' : 'Event Not Found' ?></title>
  <link rel="stylesheet" href="public/style.css">
  <script src="public/app.js"></script>
</head>
<body>
  <div class="app">
    <!-- Header -->
    <header>
        <img src="public/logo/logo.png" alt="Eventify logo" class="logo-img">
      </a>
      <nav>
        <a href="events.php?action=list" class="btn">Events</a>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="container">
      <?php if (!empty($event)): ?>
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
              <a href="tickets.php?action=checkout&event_id=<?= $event['id'] ?>" class="btn primary">Reserve Tickets</a>
            <?php else: ?>
              <a href="users.php?action=register" class="btn">Register to Reserve</a>
            <?php endif; ?>
          </div>
        </section>
      <?php else: ?>
        <section class="card center">
          <div class="alert error">Event Not Found</div>
          <p class="muted">Sorry, the event you are looking for does not exist.</p>
          <a href="events.php" class="btn primary">Back to Events</a>
        </section>
      <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer>
      Eventify &copy; 2025
    </footer>
  </div>
</body>
</html>