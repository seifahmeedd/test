
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Events</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="app">
    <!-- Header -->
    <header>
      <a href="index.php" class="eb-logo">
        <img src="logo/logo.png" alt="Eventify logo" class="logo-img" />
      </a>
      <nav>
        <a href="logout.php" class="btn">Logout</a>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="container">
      <section class="dash">
        <!-- Sidebar Navigation -->
        <aside class="sidenav card">
          <a href="admin.php?action=dashboard" class="btn">Overview</a>
          <a href="admin.php?action=addUser" class="btn">Users</a>
          <a href="admin.php?action=addEvent" class="btn active">Events</a>
          <a href="admin.php?action=logs" class="btn">Logs</a>
        </aside>

        <!-- Dashboard Body -->
        <div>
          <!-- Event List -->
          <div class="card">
            <h2>Manage Events</h2>
            <table>
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
                <?php if (!empty($events)): ?>
                  <?php foreach ($events as $event): ?>
                    <tr>
                      <td><?= $event['id'] ?></td>
                      <td><?= htmlspecialchars($event['title']) ?></td>
                      <td><?= $event['date'] ?></td>
                      <td><?= $event['capacity'] ?></td>
                      <td>
                        <a href="admin.php?action=editEvent&id=<?= $event['id'] ?>" class="btn small">Edit</a>
                        <a href="admin.php?action=deleteEvent&id=<?= $event['id'] ?>" class="btn small danger">Delete</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr><td colspan="5">No events found.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

          <!-- Add New Event Form -->
          <div class="card">
            <h3>Add New Event</h3>
            <form class="user-form" method="post" action="admin.php?action=addEvent">
              <label>Title</label>
              <input type="text" name="title" required>

              <label>Description</label>
              <textarea name="description" required></textarea>

              <label>Venue</label>
              <input type="text" name="venue" required>

              <label>Date</label>
              <input type="date" name="date" required>

              <label>Time</label>
              <input type="time" name="time" required>

              <label>Category</label>
              <input type="text" name="category">

              <label>Capacity</label>
              <input type="number" name="capacity">

              <label>Price ($)</label>
              <input type="number" step="0.01" name="price">

              <label>Status</label>
              <select name="status" required>
                <option value="active">Active</option>
                <option value="cancelled">Cancelled</option>
                <option value="sold out">Sold Out</option>
              </select>

              <button type="submit" class="btn primary">Add Event</button>
            </form>
          </div>
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