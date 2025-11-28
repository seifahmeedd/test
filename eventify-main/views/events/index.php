<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Eventify</title>
    <link rel="stylesheet" href="./public/style.css">
    <script src="./public/app.js"></script>
</head>
<body>
    <div class="app">
        <!-- Header -->
        <header>
            <a href="index.php" class="eb-logo">
                <img src="logo/logo.png" alt="Eventify logo" class="logo-img">
            </a>
            <div class="header-search">
                <input type="search" id="searchInput" placeholder="Search events..." aria-label="Search events">
            </div>
            <a href="ticket.php" class="cart-btn">
                <img src="logo/cart.svg" alt="Cart">
                <span class="cart-count">0</span>
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
            <section class="card">
                <h2>Upcoming Events</h2>
                <div class="grid">
                  <?php if (empty($events)): ?>
                    <div class="card center muted">No upcoming events available.</div>
                  <?php else: ?>
                    <?php foreach ($events as $event): ?>
                      <div class="card event-card">
                        <h3><?= htmlspecialchars($event['title']) ?></h3>
                        <p class="muted">Category: <?= htmlspecialchars($event['category']) ?></p>
                        <div class="row">
                          <span>$<?= number_format($event['price'], 2) ?></span>
                          <a href="event-details.php?id=<?= $event['id'] ?>" class="btn primary">Details</a>
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