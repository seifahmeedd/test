<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
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
          <div class="muted">Login</div>
        </div>
      </a>
      <nav>
        <a href="index.php" class="btn">Home</a>
        <a href="events.php" class="btn">Events</a>
        <a href="dashboard.php" class="btn">Dashboard</a>
        <a href="login.php" class="btn active">Login</a>
        <a href="register.php" class="btn primary">Register</a>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="container">
      <section class="card">
        <h2>Login to Your Account</h2>
        <form id="loginForm">
          <label>Email</label>
          <input type="email" id="loginEmail" required placeholder="you@example.com">

          <label>Password</label>
          <input type="password" id="loginPassword" required placeholder="********">

          <button type="submit" class="btn primary" >Login</button>
        </form>
      </section>
    </main>

    <!-- Footer -->
    <footer>
      Eventify &copy; 2025 - Login
    </footer>
  </div>
</body>
</html>