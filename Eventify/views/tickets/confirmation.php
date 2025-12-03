<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Confirmation</title>
  <link rel="stylesheet" href="public/style.css">
  <script src="public/app.js"></script>
</head>
<body>
  <div class="app">
    <!-- Header -->
    <header>
      <a href="index.php" class="eb-logo">
        <img src="public/logo/logo.png" alt="Eventify logo" class="logo-img">
      </a>
      <nav>
        <?php if (isset($_SESSION['user_id'])): ?>
          <a href="dashboard.php" class="btn">Dashboard</a>
          <a href="users.php?action=logout" class="btn">Logout</a>
        <?php else: ?>
          <a href="users.php?action=login" class="btn">Login</a>
          <a href="users.php?action=register" class="btn primary">Register</a>
        <?php endif; ?>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="container">
      <section class="card">
        <h2>Order Confirmation</h2>

        <?php if (!empty($error)): ?>
          <div class="alert error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
          <div class="alert success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <?php if (!empty($order)): ?>
          <p class="muted">Thank you for your purchase! Your order has been confirmed.</p>

          <!-- Order Summary -->
          <div class="card">
            <h3>Order #<?= $order['id'] ?></h3>
            <p><strong>Event:</strong> <?= htmlspecialchars($order['event']) ?></p>
            <p><strong>Date:</strong> <?= htmlspecialchars($order['date']) ?></p>
            <p><strong>Total:</strong> $<?= number_format($order['total'], 2) ?></p>
            <p><strong>Status:</strong> <span class="tag success">Confirmed</span></p>
          </div>

          <!-- Tickets -->
          <div class="card">
            <h3>Your Tickets</h3>
            <table>
              <thead>
                <tr>
                  <th scope="col">Seat</th>
                  <th scope="col">Code</th>
                  <th scope="col">Price</th>
                  <th scope="col">QR</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($tickets)): ?>
                  <tr><td colspan="4" class="center muted">No tickets generated.</td></tr>
                <?php else: ?>
                  <?php foreach ($tickets as $ticket): ?>
                    <tr>
                      <td><?= htmlspecialchars($ticket['seat']) ?></td>
                      <td><?= htmlspecialchars($ticket['code']) ?></td>
                      <td>$<?= number_format($ticket['price'], 2) ?></td>
                      <td>
                        <img src="https://api.qrserver.com/v1/create-qr-code/?data=<?= urlencode($ticket['code']) ?>&size=100x100" 
                             alt="QR Code for <?= htmlspecialchars($ticket['code']) ?>">
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

          <a href="dashboard.php" class="btn primary">Go to Dashboard</a>
        <?php else: ?>
          <div class="alert error">No order found.</div>
        <?php endif; ?>
      </section>
    </main>

    <!-- Footer -->
    <footer>
      Eventify &copy; 2025
    </footer>
  </div>
</body>
</html>