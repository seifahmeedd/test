<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Logs</title>
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
          <a href="adminEvents.php" class="btn">Events</a>
          <a href="adminLogs.php" class="btn active">Logs</a>
        </aside>

        <!-- Dashboard Body -->
        <div>
          <!-- Page Title -->
          <div class="card">
            <h2>System Logs</h2>
          </div>

          <!-- Summary Cards -->
          <div class="summary-cards">
            <div class="card center">
              <h3>1,250</h3>
              <p class="muted">Total Logs</p>
            </div>
            <div class="card center">
              <h3>87</h3>
              <p class="muted">Actions Today</p>
            </div>
            <div class="card center">
              <h3 >12</h3>
              <p class="muted">Errors</p>
            </div>
          </div>

          <!-- Filters -->
          <div class="card">
            <h3>Filter Logs</h3>
            <div class="row" >
              <input type="text" id="filterAction" placeholder="Filter by action or user..." />
              <input type="date" id="filterDate" />
              <button id="clearFilters" class="btn primary">Clear</button>
            </div>
          </div>

          <!-- Logs Table -->
          <div class="card" style="margin-top: 20px;">
            <table id="logsTable">
              <thead>
                <tr>
                  <th>Log ID</th>
                  <th>User</th>
                  <th>Action</th>
                  <th>Date</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>#101</td>
                  <td>Jana Ahmed</td>
                  <td>Added new event</td>
                  <td>2025-10-19</td>
                  <td><span class="status active">Success</span></td>
                </tr>
                <tr>
                  <td>#102</td>
                  <td>Omar Ali</td>
                  <td>Login attempt</td>
                  <td>2025-10-19</td>
                  <td><span class="status warning">Warning</span></td>
                </tr>
                <tr>
                  <td>#103</td>
                  <td>Sara Nabil</td>
                  <td>Deleted user account</td>
                  <td>2025-10-18</td>
                  <td><span class="status danger">Error</span></td>
                </tr>
                <tr>
                  <td>#104</td>
                  <td>Omar Ali</td>
                  <td>Updated event details</td>
                  <td>2025-10-17</td>
                  <td><span class="status active">Success</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <footer>
      Eventify &copy; 2025 - Admin Dashboard
    </footer>
  </div>

  <!-- Filter Script -->
  <script>
    const filterAction = document.getElementById('filterAction');
    const filterDate = document.getElementById('filterDate');
    const clearFilters = document.getElementById('clearFilters');
    const table = document.getElementById('logsTable').getElementsByTagName('tbody')[0];

    function filterLogs() {
      const search = filterAction.value.toLowerCase();
      const date = filterDate.value;
      const rows = table.getElementsByTagName('tr');

      for (let row of rows) {
        const user = row.cells[1].textContent.toLowerCase();
        const action = row.cells[2].textContent.toLowerCase();
        const logDate = row.cells[3].textContent;

        const matchesSearch = user.includes(search) || action.includes(search);
        const matchesDate = !date || logDate === date;

        row.style.display = matchesSearch && matchesDate ? '' : 'none';
      }
    }

    filterAction.addEventListener('input', filterLogs);
    filterDate.addEventListener('change', filterLogs);
    clearFilters.addEventListener('click', () => {
      filterAction.value = '';
      filterDate.value = '';
      filterLogs();
    });
  </script>
</body>
</html>