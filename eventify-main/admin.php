<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="app.js"></script>
</head>
<body>
    <div class="app">
        <header>
            <a href="index.php" class="eb-logo">
                <img src="logo/logo.png" alt="Eventify logo" class="logo-img">
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

        <main class="container">
            <section class="dash">
                <aside class="sidenav card">
                    <a href="admin.php" class="btn">Overview</a>
                    <a href="adminUsers.php" class="btn" >Users</a>
                    <a href="adminEvents.php" class="btn" >Events</a>
                    <a href="adminLogs.php" class="btn" >Logs</a>
                </aside>

                <div>
                    <div class="card">
                        <div class="row">
                            <h2>Event Management</h2>
                            <a href="event-details.php" class="btn primary">+ Add New Event</a>
                        </div>

                        <table >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Event Name</th>
                                    <th>Date</th>
                                    <th>Venue</th>
                                    <th>Tickets Sold</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Indie Music Night</td>
                                    <td>Nov 10, 2024</td>
                                    <td>The Loft</td>
                                    <td>45/100</td>
                                    <td><span class="tag">Active</span></td>
                                    <td>
                                        <button class="btn">Edit</button>
                                        <button class="btn">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Tech Startup Meetup</td>
                                    <td>Nov 22, 2024</td>
                                    <td>Hub 9</td>
                                    <td>89/150</td>
                                    <td><span class="tag">Active</span></td>
                                    <td>
                                        <button class="btn">Edit</button>
                                        <button class="btn">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Art & Wine Gallery</td>
                                    <td>Dec 5, 2024</td>
                                    <td>Gallery Eleven</td>
                                    <td>23/50</td>
                                    <td><span class="tag">Active</span></td>
                                    <td>
                                        <button class="btn">Edit</button>
                                        <button class="btn">View</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card" >
                        <h3>Quick Stats</h3>
                        <div class="grid">
                            <div class="card center">
                                <h3>156</h3>
                                <p class="muted">Total Tickets Sold</p>
                            </div>
                            <div class="card center">
                                <h3>8</h3>
                                <p class="muted">Active Events</p>
                            </div>
                            <div class="card center">
                                <h3>$2,450</h3>
                                <p class="muted">Total Revenue</p>
                            </div>
                            <div class="card center">
                                <h3>89</h3>
                                <p class="muted">Registered Users</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer>
            Eventify &copy; 2024 - Admin Dashboard
        </footer>
    </div>
</body>
</html>