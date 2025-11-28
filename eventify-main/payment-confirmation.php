<?php
session_start();
include 'db.php';

 //Require login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Simulate retrieving cart from session (you can adapt to DB/localStorage)
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Generate order number
$orderNumber = "EVT-" . str_pad(rand(1,999), 3, "0", STR_PAD_LEFT);

// Calculate total
$totalPaid = 0;
foreach ($cart as $item) {
    $totalPaid += $item['price'] * $item['qty'];
}

// Insert into orders table
$sql = "INSERT INTO orders (order_number, user_id, total, status) VALUES (?, ?, ?, 'paid')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sid", $orderNumber, $_SESSION['user_id'], $totalPaid);
$stmt->execute();

// Get inserted order ID
$orderId = $conn->insert_id;

// Log the payment
$logSql = "INSERT INTO logs (user_id, action, status) VALUES (?, ?, ?)";
$logStmt = $conn->prepare($logSql);
$action = "Checkout completed, Order $orderNumber";
$status = "success";
$logStmt->bind_param("iss", $_SESSION['user_id'], $action, $status);
$logStmt->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Payment Confirmed</title>
  <link rel="stylesheet" href="style.css" />
  <script src="app.js"></script>
</head>
<body>
  <div class="app">
    <!-- Header -->
    <header>
      <a href="index.php" class="eb-logo">
        <img src="logo/logo.png" alt="Eventify logo" class="logo-img" />
        <div>
          <div class="brand">Eventify</div>
          <div class="muted">Payment Successful</div>
        </div>
      </a>
      <nav>
        <a href="index.php" class="btn">Home</a>
        <a href="events.php" class="btn">Events</a>
        <a href="dashboard.php" class="btn">Dashboard</a>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="container">
      <section class="card center">
        <div>✅</div>
        <h1>Payment Successful!</h1>
        <p class="muted">Thank you for your purchase. Your tickets have been confirmed.</p>

        <!-- Order Details -->
        <div class="card">
          <h3>Order Details</h3>
          <div class="row">
            <span>Order Number:</span>
            <strong>#<?= htmlspecialchars($orderNumber) ?></strong>
          </div>
          <div class="row">
            <span>Total Paid:</span>
            <strong>$<?= number_format($totalPaid, 2) ?></strong>
          </div>
        </div>

        <div class="row">
          <a href="dashboard.php" class="btn">Go to Dashboard</a>
          <a href="ticket.php?order_id=<?= $orderId ?>" class="btn primary">Download Tickets</a>
        </div>

        <p class="muted">
          A confirmation email has been sent to your email address.
        </p>
      </section>
    </main>

    <!-- Footer -->
    <footer>
      Eventify &copy; 2025
    </footer>
  </div>
</body>
</html>