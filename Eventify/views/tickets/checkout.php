<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  <link rel="stylesheet" href="public/style.css">
  <script src="public/app.js"></script>
</head>
<body>
  <div class="app">
    <!-- Header -->
    <header>
        <img src="public/logo/logo.png" alt="Eventify logo" class="logo-img">
    </header>

    <!-- Main Content -->
    <main class="container">
      <section class="hero">
        <!-- Left: Order Summary -->
        <div class="left card">
          <h2>Order Summary</h2>

          <?php if (!empty($error)): ?>
            <div class="alert error"><?= htmlspecialchars($error) ?></div>
          <?php endif; ?>
          <?php if (!empty($success)): ?>
            <div class="alert success"><?= htmlspecialchars($success) ?></div>
          <?php endif; ?>

          <?php if (empty($cart)): ?>
            <p class="muted">Your cart is empty.</p>
          <?php else: ?>
            <?php foreach ($cart as $item): ?>
              <div class="row">
                <div>
                  <h4><?= htmlspecialchars($item['title']) ?></h4>
                  <p class="muted"><?= (int)$item['qty'] ?> × Ticket</p>
                </div>
                <div>$<?= number_format($item['price'] * $item['qty'], 2) ?></div>
              </div>
            <?php endforeach; ?>
            <hr>
            <div class="row">
              <strong>Total:</strong>
              <strong>$<?= number_format($total, 2) ?></strong>
            </div>
          <?php endif; ?>
        </div>

        <!-- Right: Payment Form -->
        <div class="right card">
          <h2>Payment Details</h2>
          <form method="POST" action="tickets.php?action=checkout&event_id=<?= htmlspecialchars($event_id ?? '') ?>" class="form">
            <div class="form-group">
              <label for="cardName">Cardholder Name</label>
              <input id="cardName" type="text" name="cardName" required>
            </div>

            <div class="form-group">
              <label for="cardNumber">Card Number</label>
              <input id="cardNumber" type="text" name="cardNumber" maxlength="16" required>
            </div>

            <div class="form-group row">
              <div>
                <label for="expiry">Expiry Date</label>
            <input type="month" name="expiry" required placeholder="MM/YY">
              </div>
              <div>
                <label for="cvv">CVV</label>
                <input id="cvv" type="text" name="cvv" maxlength="4" required>
              </div>
            </div>

            <button type="submit" class="btn primary">Confirm Payment</button>
          </form>
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