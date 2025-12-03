<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Events</title>
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
        <?php if (isset($_SESSION['user_id'])): ?>
          <a href="users.php?action=dashboard" class="btn">Dashboard</a>
          <a href="users.php?action=logout" class="btn">Logout</a>
        <?php endif; ?>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="container">
      <section class="card">
        <h2>All Events</h2>
        <div class="grid">
          <?php if (empty($events)): ?>
            <div class="alert error center">No events found.</div>
          <?php else: ?>
            <?php foreach ($events as $event): ?>
              <div class="card event-card">
                <h3><?= htmlspecialchars($event['title']) ?></h3>
                <p class="muted">
                  <?= htmlspecialchars($event['category']) ?> • 
                  <?= htmlspecialchars($event['venue']) ?> • 
                  <?= htmlspecialchars($event['date']) ?>
                </p>
                <div class="row">
                  <span>$<?= number_format($event['price'], 2) ?></span>
                  <a href="events.php?action=details&id=<?= $event['id'] ?>" class="btn primary">Details</a>
                </div>
              </div>
            <?php endforeach; ?>
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