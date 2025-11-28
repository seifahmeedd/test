<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Checkout</title>
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
        <a href="events.php" class="btn">Events</a>
        <a href="dashboard.php" class="btn">Dashboard</a>
        <a href="login.php" class="btn">Login</a>
        <a href="register.php" class="btn primary">Register</a>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="container">
      <section class="hero">
        <!-- Left: Cart Summary -->
        <div class="left">
          <div class="card">
            <h2>Your Order</h2>
            <!-- JS will inject cart items here -->
          </div>
        </div>

        <!-- Right: Payment Form -->
        <div class="right card">
          <h2>Payment Details</h2>
          <form action="payment-confirmation.php" method="post">
            <label>Card Number</label>
            <input type="text" name="card" required placeholder="1234 5678 9012 3456">

            <label>Expiry Date</label>
            <input type="month" name="expiry" required placeholder="MM/YY">

            <label>CVV</label>
            <input type="text" name="cvv" required placeholder="123">

            <button type="submit" class="btn primary" >Pay Now</button>
          </form>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <footer>
      Eventify &copy; 2025
    </footer>
  </div>

  <!-- Call JS after DOM is ready -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      renderCheckout();
    });
  </script>
</body>
</html>