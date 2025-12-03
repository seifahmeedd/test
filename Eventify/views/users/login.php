<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="public/style.css" />
  <script src="public/app.js"></script>
</head>
<body>
  <div class="app">
    <!-- Header -->
    <header>
      <a href="events.php?action=home" class="eb-logo">
        <img src="public/logo/logo.png" alt="Eventify logo" class="logo-img">
      </a>
    </header>

    <!-- Main Content -->
    <main class="container">
      <section class="card form-card">
        <h2>Login to Your Account</h2>

        <?php if (!empty($error)): ?>
          <div class="alert error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
          <div class="alert success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST" action="users.php?action=login" id="loginForm" class="form">
          <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" required placeholder="you@example.com">
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required placeholder="********">
          </div>

          <button type="submit" class="btn primary">Login</button>
        </form>

        <p class="muted">
          Don't have an account? <a href="users.php?action=register">Register here</a>
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