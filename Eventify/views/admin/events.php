<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manage Events</title>
  <link rel="stylesheet" href="public/style.css">
  <script src="public/app.js"></script>
</head>
<body>
  <div class="app">
    <!-- Header -->
    <header>
      <a href="admin.php?action=dashboard" class="eb-logo">
        <img src="public/logo/logo.png" alt="Eventify logo" class="logo-img">
      </a>
      <nav>
        <a href="users.php?action=logout" class="btn">Logout</a>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="container">
      <section class="dash">
        <!-- Sidebar Navigation -->
        <aside class="sidenav card">
          <a href="admin.php?action=dashboard" class="btn">Overview</a>
          <a href="admin.php?action=users" class="btn">Users</a>
          <a href="admin.php?action=events" class="btn active">Events</a>
          <a href="admin.php?action=logs" class="btn">Logs</a>
        </aside>

        <!-- Events Management -->
        <div>
          <div class="card">
            <h2>Manage Events</h2>
            <a href="admin.php?action=addEvent" class="btn primary">+ Add New Event</a>
          </div>

          <!-- Alerts -->
          <?php if (isset($_GET['msg'])): ?>
            <div class="alert <?= ($_GET['msg'] === 'error' ? 'error' : 'success') ?>">
              <?php if ($_GET['msg'] === 'added'): ?>
                Event added successfully.
              <?php elseif ($_GET['msg'] === 'updated'): ?>
                Event updated successfully.
              <?php elseif ($_GET['msg'] === 'deleted'): ?>
                Event deleted successfully.
              <?php elseif ($_GET['msg'] === 'notfound'): ?>
                Event not found.
              <?php elseif ($_GET['msg'] === 'deleteerror'): ?>
                Error deleting event.
              <?php endif; ?>
            </div>
          <?php endif; ?>

          <div class="card">
            <table>
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Title</th>
                  <th scope="col">Category</th>
                  <th scope="col">Date</th>
                  <th scope="col">Price</th>
                  <th scope="col">Status</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($events)): ?>
                  <tr><td colspan="7" class="center muted">No events found.</td></tr>
                <?php else: ?>
                  <?php foreach ($events as $event): ?>
                    <tr>
                      <td>#<?= $event['id'] ?></td>
                      <td><?= htmlspecialchars($event['title']) ?></td>
                      <td><?= htmlspecialchars($event['category']) ?></td>
                      <td><?= $event['date'] ?></td>
                      <td>$<?= number_format($event['price'], 2) ?></td>
                      <td>
                        <span class="tag 
                        <?= $event['status'] === 'active' ? 'success' : 
                           ($event['status'] === 'cancelled' ? 'danger' : 
                           ($event['status'] === 'sold_out' ? 'warning' : '')) ?>">
                          <?= ucfirst($event['status']) ?>
                        </span>
                      </td>
                      <td>
                        <a href="admin.php?action=editEvent&id=<?= $event['id'] ?>" class="btn">Edit</a>
                        <a href="admin.php?action=deleteEvent&id=<?= $event['id'] ?>"
                           class="btn danger"
                           onclick="return confirm('Are you sure you want to delete this event?');">
                           Delete
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
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