/* ===========================
   Eventify App JavaScript
   =========================== */

// Global state
const state = {
  cart: JSON.parse(localStorage.getItem('cart')) || [],
  user: JSON.parse(localStorage.getItem('user')) || null,
  events: JSON.parse(localStorage.getItem('events')) || [] // ✅ ensure events are loaded
};

/* ===========================
   Cart Functions
   =========================== */
function updateCartCount() {
  const count = state.cart.reduce((sum, item) => sum + item.qty, 0);
  const cartEl = document.querySelector('.cart-count');
  if (cartEl) cartEl.textContent = count;
}
updateCartCount();

function addToCart(eventId, qty = 1) {
  const event = state.events.find(e => e.id == eventId);
  if (!event) return;
  const existing = state.cart.find(i => i.id == eventId);
  if (existing) {
    existing.qty += qty;
  } else {
    state.cart.push({ ...event, qty });
  }
  localStorage.setItem('cart', JSON.stringify(state.cart));
  updateCartCount();
}

/* ===========================
   Event Rendering
   =========================== */
function renderEvents() {
  const grid = document.querySelector('.grid');
  if (!grid) return;
  grid.innerHTML = state.events.map(e => `
    <div class="card event-card center">
      <div class="event-emoji">${e.emoji || "🎫"}</div>
      <h3>${e.title}</h3>
      <p class="muted">${e.date} • ${e.venue}</p>
      <a href="event-details.php?id=${e.id}" class="btn primary">View Details</a>
    </div>
  `).join('');
}

function renderEventDetails() {
  const params = new URLSearchParams(window.location.search);
  const id = params.get('id');
  const event = state.events.find(e => e.id == id);
  if (!event) return;

  const titleEl = document.querySelector('.left h2');
  const infoEl = document.querySelector('.left p.muted');
  const priceEl = document.querySelector('.right h2');

  if (titleEl) titleEl.textContent = event.title;
  if (infoEl) infoEl.textContent = `${event.venue} • ${event.date}`;
  if (priceEl) priceEl.textContent = `$${event.price}`;
}

/* ===========================
   Dashboard Section Toggle
   =========================== */
function showSection(sectionId) {
  document.querySelectorAll('.dashboard-section').forEach(s => s.classList.remove('active'));
  const section = document.getElementById(sectionId);
  if (section) section.classList.add('active');

  document.querySelectorAll('.sidenav a').forEach(link => link.classList.remove('active'));
  const activeLink = document.querySelector(`.sidenav a[href="#${sectionId}"]`);
  if (activeLink) activeLink.classList.add('active');
}

/* ===========================
   Checkout Rendering
   =========================== */
function renderCheckout() {
  const cart = state.cart;
  const summary = document.querySelector('.left .card');
  if (!summary) return;

  summary.innerHTML = cart.map(item => `
    <div class="row">
      <div>
        <h4>${item.title}</h4>
        <p class="muted">${item.qty} × Ticket</p>
      </div>
      <div>$${item.price * item.qty}</div>
    </div>
  `).join('');
}

/* ===========================
   Ticket Rendering
   =========================== */
function renderTicket() {
  const ticket = JSON.parse(localStorage.getItem('ticket'));
  if (!ticket) return;

  document.querySelector('.ticket-card h2').textContent = ticket.event;
  document.querySelector('.ticket-info').innerHTML = `
    <div><strong>Seat:</strong> ${ticket.seat}</div>
    <div><strong>Time:</strong> ${ticket.time}</div>
    <div><strong>Price:</strong> ${ticket.price}</div>
    <div><strong>Entry Code:</strong> ${ticket.code}</div>
  `;
  document.querySelector('.qr-area img').src =
    `https://api.qrserver.com/v1/create-qr-code/?data=${ticket.code}&size=130x130`;
}

/* ===========================
   Dashboard Rendering
   =========================== */
function renderDashboard() {
  const userNameEl = document.getElementById('userName');
  if (userNameEl) {
    if (state.user?.name) {
      userNameEl.textContent = state.user.name;
    } else if (state.user?.email) {
      userNameEl.textContent = state.user.email;
    }
  }

  const tickets = JSON.parse(localStorage.getItem('tickets')) || [];
  const ticketsTable = document.getElementById('ticketsTable');
  if (ticketsTable) {
    ticketsTable.innerHTML = tickets.map(t => `
      <tr>
        <td>${t.event}</td>
        <td>${t.date}</td>
        <td>${t.seat}</td>
        <td>${t.code}</td>
      </tr>
    `).join('');
  }

  const orders = JSON.parse(localStorage.getItem('orders')) || [];
  const ordersTable = document.getElementById('ordersTable');
  if (ordersTable) {
    ordersTable.innerHTML = orders.map(o => `
      <tr>
        <td>${o.id}</td>
        <td>${o.event}</td>
        <td>${o.date}</td>
        <td>$${o.total}</td>
        <td><span class="tag">${o.status}</span></td>
      </tr>
    `).join('');
  }
}

/* ===========================
   Admin Dashboard Rendering
   =========================== */
function renderAdminDashboard() {
  const table = document.getElementById("adminEventsTable");
  if (table) {
    table.innerHTML = state.events.map(e => `
      <tr>
        <td>${e.id}</td>
        <td>${e.title}</td>
        <td>${e.date}</td>
        <td>${e.venue}</td>
        <td>${e.capacity || 0}/${e.capacity || 100}</td>
        <td><span class="tag">${e.status || "Active"}</span></td>
        <td>
          <button class="btn">Edit</button>
          <button class="btn">View</button>
        </td>
      </tr>
    `).join('');
  }

  const statsGrid = document.getElementById("adminStatsGrid");
  if (statsGrid) {
    const totalTickets = state.events.reduce((sum, e) => sum + (e.capacity || 0), 0);
    const soldTickets = state.events.reduce((sum, e) => sum + (e.sold || 0), 0);
    const revenue = state.events.reduce((sum, e) => sum + (e.revenue || 0), 0);

    const stats = [
      { value: soldTickets, label: "Total Tickets Sold" },
      { value: state.events.length, label: "Active Events" },
      { value: `$${revenue}`, label: "Total Revenue" },
      { value: state.user ? 1 : 0, label: "Registered Users" } // ✅ dynamic placeholder
    ];

    statsGrid.innerHTML = stats.map(s => `
      <div class="card center">
        <h3>${s.value}</h3>
        <p class="muted">${s.label}</p>
      </div>
    `).join('');
  }
}

/* ===========================
   Event Search Functionality
   =========================== */
function initSearch() {
  const searchInput = document.getElementById("searchInput");
  if (!searchInput) return;

  searchInput.addEventListener("input", () => {
    const query = searchInput.value.toLowerCase();
    document.querySelectorAll(".event-card").forEach(card => {
      const title = card.querySelector("h3").textContent.toLowerCase();
      const category = card.querySelector(".muted").textContent.toLowerCase();
      card.style.display = (title.includes(query) || category.includes(query)) ? "block" : "none";
    });
  });
}

/* ===========================
   Page Loader
   =========================== */
document.addEventListener("DOMContentLoaded", () => {
  const page = getPageName();

  // Public pages
  if (page === "index.php" || page === "events.php") {
    renderEvents();
    initSearch();
  }
  if (page === "event-details.php") {
    renderEventDetails();
  }
  if (page === "checkout.php") {
    renderCheckout();
  }
  if (page === "tickets.php") {
    renderTicket();
  }
  if (page === "dashboard.php") {
    renderDashboard();
  }
  if (page === "admin.php") {
    renderAdminDashboard();
  }

  // Login validation
  if (page === "login.php") {
    const form = document.getElementById("loginForm");
    if (form) {
      form.addEventListener("submit", e => {
        const email = document.getElementById("loginEmail").value.trim();
        const password = document.getElementById("loginPassword").value;

        if (!email || !password) {
          e.preventDefault();
          alert("Please enter both email and password.");
        }
      });
    }
  }

  // Register validation
  if (page === "register.php") {
    const form = document.getElementById("registerForm");
    if (form) {
      form.addEventListener("submit", e => {
        const name = document.getElementById("registerName").value.trim();
        const email = document.getElementById("registerEmail").value.trim();
        const password = document.getElementById("registerPassword").value;
        const confirmPassword = document.getElementById("registerConfirmPassword").value;

        const isLongEnough = password.length >= 8;
        const hasUppercase = /[A-Z]/.test(password);
        const isValidDomain = /\.(com)$/.test(email);
        const isAllowedProvider = /(gmail|outlook|hotmail)\./.test(email);

        if (password !== confirmPassword) {
          e.preventDefault();
          alert("Passwords do not match!");
          return;
        }
        if (!isLongEnough || !hasUppercase) {
          e.preventDefault();
          alert("Password must be at least 8 characters and contain an uppercase letter.");
          return;
        }
        if (!isValidDomain || !isAllowedProvider) {
          e.preventDefault();
          alert("Email must be from gmail, outlook, or hotmail and end with .com");
          return;
        }
      });
    }
  }
});