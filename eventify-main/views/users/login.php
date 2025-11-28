<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="app">
    <!-- Header -->
    <header>
      <a href="index.php" class="eb-logo">
        <img src="logo/logo.png" alt="Eventify logo" class="logo-img" />
        <div>
          <div class="brand">Eventify</div>
          <div class="muted">Login</div>
        </div>
      </a>
    </header>

    <!-- Main Content -->
    <main class="container">
      <section class="card form-card">
        <h2>Login to Your Account</h2>

        <?php if (!empty($error)): ?>
          <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST" action="login.php" id="loginForm" class="form">
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
          Don't have an account? <a href="register.php">Register here</a>
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