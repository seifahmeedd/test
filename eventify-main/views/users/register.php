<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
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
          <div class="muted">Register</div>
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
          <a href="register.php" class="btn primary active">Register</a>
        <?php endif; ?>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="container">
      <section class="card form-card">
        <h2>Create a New Account</h2>

        <?php if (!empty($error)): ?>
          <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST" action="register.php" id="registerForm" class="form">
          <div class="form-group">
            <label for="registerName">Name</label>
            <input id="registerName" type="text" name="name" required placeholder="Full Name">
          </div>

          <div class="form-group">
            <label for="registerEmail">Email</label>
            <input id="registerEmail" type="email" name="email" required placeholder="you@example.com">
          </div>

          <div class="form-group">
            <label for="registerPassword">Password</label>
            <input id="registerPassword" type="password" name="password" required placeholder="********">
          </div>

          <div class="form-group">
            <label for="registerConfirmPassword">Confirm Password</label>
            <input id="registerConfirmPassword" type="password" name="confirm_password" required placeholder="********">
          </div>

          <button type="submit" class="btn primary">Register</button>
        </form>

        <p class="muted">
          Already have an account? <a href="login.php">Login here</a>
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