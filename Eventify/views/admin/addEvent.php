<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Event</title>
  <link rel="stylesheet" href="public/style.css">
  <script src="public/app.js"></script>
</head>
<body>
<div class="app">
  <main class="container">
    <section class="card form-card">
      <h2>Add New Event</h2>

      <?php if (!empty($error)): ?>
        <div class="alert error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>
      <?php if (!empty($success)): ?>
        <div class="alert success"><?= htmlspecialchars($success) ?></div>
      <?php endif; ?>

      <form method="post" action="admin.php?action=addEvent" class="form">
        <div class="form-group">
          <label for="title">Title</label>
          <input id="title" type="text" name="title" required>
        </div>

        <div class="form-group">
          <label for="description">Description</label>
          <textarea id="description" name="description" required></textarea>
        </div>

        <div class="form-group">
          <label for="venue">Venue</label>
          <input id="venue" type="text" name="venue" required>
        </div>

        <div class="form-group">
          <label for="date">Date</label>
          <input id="date" type="date" name="date" required>
        </div>

        <div class="form-group">
          <label for="time">Time</label>
          <input id="time" type="time" name="time" required>
        </div>

        <div class="form-group">
          <label for="category">Category</label>
          <input id="category" type="text" name="category">
        </div>

        <div class="form-group">
          <label for="capacity">Capacity</label>
          <input id="capacity" type="number" name="capacity">
        </div>

        <div class="form-group">
          <label for="price">Price ($)</label>
          <input id="price" type="number" step="0.01" name="price">
        </div>

        <div class="form-group">
          <label for="status">Status</label>
          <select id="status" name="status" required>
            <option value="active">Active</option>
            <option value="cancelled">Cancelled</option>
            <option value="sold _out">Sold Out</option>
          </select>
        </div>

        <button type="submit" class="btn primary">Add Event</button>
      </form>
    </section>
  </main>
</div>
</body>
</html>