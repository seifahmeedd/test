<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Events</title>
  <link rel="stylesheet" href="style.css">
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
          <div class="muted">Admin Dashboard</div>
        </div>
      </a>
      <nav>
        <a href="index.php" class="btn">Home</a>
        <a href="admin.php" class="btn">Admin</a>
        <a href="login.php" class="btn">Logout</a>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="container">
      <section class="dash">
        <!-- Sidebar Navigation -->
        <aside class="sidenav card">
          <a href="admin.php" class="btn">Overview</a>
          <a href="adminUsers.php" class="btn">Users</a>
          <a href="adminEvents.php" class="btn active">Events</a>
          <a href="adminLogs.php" class="btn">Logs</a>
        </aside>

        <!-- Dashboard Body -->
        <div>
          <!-- Event List -->
          <div class="card">
            <h2>Manage Events</h2>
            <table >
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Event Name</th>
                  <th>Date</th>
                  <th>Tickets</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Music Festival</td>
                  <td>2025-12-01</td>
                  <td>300</td>
                  <td>
                    <button class="btn small">Edit</button>
                    <button class="btn small danger">Delete</button>
                  </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Tech Conference</td>
                  <td>2026-01-15</td>
                  <td>150</td>
                  <td>
                    <button class="btn small">Edit</button>
                    <button class="btn small danger">Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Add New Event Form -->
          <div class="card">
            <h3>Add New Event</h3>
            <form class="user-form">
              <div class="form-grid">
                <div>
                  <label>Title</label>
                  <input type="text" placeholder="Enter event name" />
                </div>
                <div>
                  <label>Time</label>
                  <input type="time" />
                </div>
                <div>
                  <label>Date</label>
                  <input type="date" />
                </div>
                <div>
                  <label>Category</label>
                  <input type="text" placeholder="Enter event category" />
                </div>
                <div>
                  <label>Tickets</label>
                  <input type="number" min="0" />
                </div>
                <div>
                  <label>Price ($)</label>
                  <input type="number" step="0.01" min="0" />
                </div>
              </div>
              <button class="btn primary" type="submit">Add Event</button>
            </form>
          </div>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <footer>
      Eventify &copy; 2025 - Admin Dashboard
    </footer>
  </div>
</body>
</html>