<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add User</title>
  <link rel="stylesheet" href="public/style.css">
  <script src="public/app.js"></script>
</head>
<body>
<div class="app">
  <main class="container">
    <section class="card form-card">
      <h2>Add New User</h2>

      <?php if (!empty($error)): ?>
        <div class="alert error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>
      <?php if (!empty($success)): ?>
        <div class="alert success"><?= htmlspecialchars($success) ?></div>
      <?php endif; ?>

      <form method="post" action="admin.php?action=addUser" class="form">
        <div class="form-group">
          <label for="name">Name</label>
          <input id="name" type="text" name="name" required>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input id="email" type="email" name="email" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input id="password" type="password" name="password" required>
        </div>

        <div class="form-group">
          <label for="role">Role</label>
          <select id="role" name="role" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
          </select>
        </div>

        <div class="form-group">
          <label for="status">Status</label>
          <select id="status" name="status" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
            <option value="banned">Banned</option>
          </select>
        </div>

        <button type="submit" class="btn primary">Add User</button>
      </form>
    </section>
  </main>
</div>
</body>
</html>