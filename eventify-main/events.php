<?php
include 'db.php';
$events = [];
$sql = "SELECT id, title, description, date, price, category FROM events ORDER BY id ASC";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}
?>


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

      </a>
      <nav>
        <a href="index.php" class="btn">Home</a>
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
        </aside>

        <!-- Event List -->
        <div>
          <div class="card">
            <h2>Upcoming Events</h2>
            <p class="muted">Browse and book your favorite events 🎉</p>
          </div>

          <!-- JS will populate this grid -->
          <div class="grid">
  <?php foreach ($events as $event): ?>
    <div class="card">
      <h3><?= htmlspecialchars($event['title']) ?></h3>
<p class="muted">Category: <?= htmlspecialchars($event['category']) ?></p>      <div class="row" style="justify-content: space-between;">
        <span>$<?= number_format($event['price'], 2) ?></span>
        <a href="event-details.php?id=<?= $event['id'] ?>" class="btn primary">Details</a>
      </div>
    </div>
  <?php endforeach; ?>
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