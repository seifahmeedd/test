<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="app">
    <main class="container">
      <section class="card form-card">
        <h2>Edit User</h2>

        <?php if (!empty($error)): ?>
          <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (!empty($user)): ?>
          <form method="POST" class="form">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">

            <div class="form-group">
              <label for="name">Name</label>
              <input id="name" type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input id="email" type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>

            <div class="form-group">
              <label for="role">Role</label>
              <select id="role" name="role">
                <option value="user" <?= $user['role']=='user'?'selected':'' ?>>User</option>
                <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
              </select>
            </div>

            <div class="form-group">
              <label for="status">Status</label>
              <select id="status" name="status">
                <option value="active" <?= $user['status']=='active'?'selected':'' ?>>Active</option>
                <option value="suspended" <?= $user['status']=='suspended'?'selected':'' ?>>Suspended</option>
              </select>
            </div>

            <button type="submit" class="btn primary">Save Changes</button>
          </form>
        <?php else: ?>
          <p class="muted">User not found.</p>
        <?php endif; ?>
      </section>
    </main>
  </div>
</body>
</html>