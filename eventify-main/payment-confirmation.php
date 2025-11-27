<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmed</title>
    <link rel="stylesheet" href="style.css">
    <script src="app.js"></script>
</head>
<body>
    <div class="app">
        <header>
            <a href="index.php" class="eb-logo">
                <img src="logo/logo.png" alt="Eventify logo" class="logo-img">
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

        <main class="container">
            <section class="card center" style="flex-direction: column; padding: 40px; text-align: center;">
                <div style="font-size: 4em; margin-bottom: 20px;">✅</div>
                <h1>Payment Successful!</h1>
                <p class="muted">Thank you for your purchase. Your tickets have been confirmed.</p>
                
                <div class="card" style="margin: 20px 0; text-align: left;">
                    <h3>Order Details</h3>
                    <div class="row" style="justify-content: space-between;">
                        <span>Order Number:</span>
                        <strong>#EVT-001</strong>
                    </div>
                    <div class="row" style="justify-content: space-between;">
                        <span>Event:</span>
                        <span>Indie Music Night</span>
                    </div>
                    <div class="row" style="justify-content: space-between;">
                        <span>Date:</span>
                        <span>Nov 10, 2024 • 7:00 PM</span>
                    </div>
                    <div class="row" style="justify-content: space-between;">
                        <span>Total Paid:</span>
                        <strong>$29.25</strong>
                    </div>
                </div>

                <div class="row" style="justify-content: center; gap: 15px;">
                    <a href="dashboard.php" class="btn">Go to Dashboard</a>
                    <a href="ticket.php" class="btn primary">Download Tickets</a>
                </div>

                <p class="muted" style="margin-top: 20px;">
                    A confirmation email has been sent to your email address.
                </p>
            </section>
        </main>

        <footer>
            Eventify &copy; 2024 - Payment Confirmed
        </footer>
    </div>
</body>
</html>