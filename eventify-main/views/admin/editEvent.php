<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Event</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="app">
    <main class="container">
      <section class="card form-card">
        <h2>Edit Event</h2>

        <?php if (!empty($error)): ?>
          <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (!empty($event)): ?>
          <form method="POST" class="form">
            <input type="hidden" name="id" value="<?= $event['id'] ?>">

            <div class="form-group">
              <label for="title">Title</label>
              <input id="title" type="text" name="title" value="<?= htmlspecialchars($event['title']) ?>" required>
            </div>

            <div class="form-group">
              <label for="description">Description</label>
              <textarea id="description" name="description" required><?= htmlspecialchars($event['description']) ?></textarea>
            </div>

            <div class="form-group">
              <label for="venue">Venue</label>
              <input id="venue" type="text" name="venue" value="<?= htmlspecialchars($event['venue']) ?>" required>
            </div>

            <div class="form-group">
              <label for="date">Date</label>
              <input id="date" type="date" name="date" value="<?= htmlspecialchars($event['date']) ?>" required>
            </div>

            <div class="form-group">
              <label for="time">Time</label>
              <input id="time" type="time" name="time" value="<?= htmlspecialchars($event['time']) ?>" required>
            </div>

            <div class="form-group">
              <label for="category">Category</label>
              <input id="category" type="text" name="category" value="<?= htmlspecialchars($event['category']) ?>" required>
            </div>

            <div class="form-group">
              <label for="capacity">Capacity</label>
              <input id="capacity" type="number" name="capacity" value="<?= htmlspecialchars($event['capacity']) ?>" required>
            </div>

            <div class="form-group">
              <label for="price">Price</label>
              <input id="price" type="number" step="0.01" name="price" value="<?= htmlspecialchars($event['price']) ?>" required>
            </div>

            <div class="form-group">
              <label for="status">Status</label>
              <select id="status" name="status">
                <option value="active" <?= $event['status']=='active'?'selected':'' ?>>Active</option>
                <option value="cancelled" <?= $event['status']=='cancelled'?'selected':'' ?>>Cancelled</option>
              </select>
            </div>

            <button type="submit" class="btn primary">Save Changes</button>
          </form>
        <?php else: ?>
          <p class="muted">Event not found.</p>
        <?php endif; ?>
      </section>
    </main>
  </div>
</body>
</html>