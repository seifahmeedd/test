<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
    <script src="app.js"></script>
</head>
<body>
    <div class="app">
        <header>
            <a href="index.php" class="eb-logo">
                <img src="logo/logo.png" alt="Eventify logo" class="logo-img">
            </a>
            <div class="header-search">
                <input type="search" placeholder="Search events...">
            </div>
            <a href="ticket.php" class="cart-btn">
                <img src="logo/cart.svg" alt="Cart">
                <span class="cart-count">0</span>
            </a>
            <nav>
                <a href="index.php" class="btn">Home</a>
                <a href="events.php" class="btn">Events</a>
                <a href="dashboard.php" class="btn">Dashboard</a>
                <a href="login.php" class="btn">Login</a>
                <a href="register.php" class="btn primary">Register</a>
            </nav>
        </header>

        <main class="container">
            <section class="card">
                <h2>Upcoming Events</h2>
                <!-- JS will populate this grid -->
                <div class="grid"></div>
            </section>
        </main>

        <footer>
            Eventify &copy; 2024 - Event Ticketing System
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