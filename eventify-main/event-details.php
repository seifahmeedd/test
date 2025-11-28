<?php
session_start();
include 'db.php';

$eventId = $_GET['id'] ?? null;
if (!$eventId) {
    die("No event selected.");
}

$sql = "SELECT title, description, venue, date, time, price FROM events WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $eventId);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();

if (!$event) {
    die("Event not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($event['title']) ?> - Event Details</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="app">
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

    <main class="container">
      <section class="hero">
        <div class="left">
          <h2><?= htmlspecialchars($event['title']) ?></h2>
          <p class="muted"><?= htmlspecialchars($event['venue']) ?> • <?= htmlspecialchars($event['date']) ?> at <?= htmlspecialchars($event['time']) ?></p>
          <p><?= htmlspecialchars($event['description']) ?></p>
        </div>

        <div class="right card">
          <h2>$<?= number_format($event['price'], 2) ?></h2>
          <?php if (isset($_SESSION['user_id'])): ?>
            <a href="checkout.php?event_id=<?= $eventId ?>" class="btn primary">Add to Cart</a>
          <?php else: ?>
            <p class="muted">Please <a href="login.php">login</a> or <a href="register.php">register</a> to reserve tickets.</p>
          <?php endif; ?>
        </div>
      </section>
    </main>

    <footer>
      Eventify &copy; 2025
    </footer>
  </div>
</body>
</html>