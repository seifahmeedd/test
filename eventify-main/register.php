<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
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
          <div class="muted">Register</div>
        </div>
      </a>
      <nav>
        <a href="index.php" class="btn">Home</a>
        <a href="events.php" class="btn">Events</a>
        <a href="dashboard.php" class="btn">Dashboard</a>
        <a href="login.php" class="btn">Login</a>
        <a href="register.php" class="btn primary active">Register</a>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="container">
      <section class="card">
        <h2>Create a New Account</h2>
        <form id="registerForm">
          <label>Name</label>
          <input type="text" id="registerName" required placeholder="Full Name">

          <label>Email</label>
          <input type="email" id="registerEmail" required placeholder="you@example.com">

          <label>Password</label>
          <input type="password" id="registerPassword" required placeholder="********">

          <label>Confirm Password</label>
          <input type="password" id="registerConfirmPassword" required placeholder="********">

          <button type="submit" class="btn primary">Register</button>
        </form>
      </section>
    </main>

    <!-- Footer -->
    <footer>
      Eventify &copy; 2025 - Register
    </footer>
  </div>
</body>
</html>