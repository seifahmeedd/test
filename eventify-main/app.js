/* ===========================
   Eventify App JavaScript
   =========================== */

// Global state
const state = {
  cart: JSON.parse(localStorage.getItem('cart')) || [],
  user: JSON.parse(localStorage.getItem('user')) || null,
  events: [
    {id:1, title:"Concert Night 2025", date:"2025-11-22", venue:"Cairo Opera House", price:250, emoji:"🎶"},
    {id:2, title:"Drama Theatre Show", date:"2025-12-05", venue:"Alexandria Cultural Center", price:150, emoji:"🎭"},
    {id:3, title:"Charity Football Match", date:"2025-12-10", venue:"Cairo Stadium", price:100, emoji:"⚽"},
    {id:4, title:"Open Mic Comedy Night", date:"2025-12-20", venue:"The Spot Mall, New Cairo", price:75, emoji:"🎤"},
    {id:5, title:"Art Exhibition", date:"2026-01-12", venue:"Cairo Art Museum", price:50, emoji:"🎨"},
    {id:6, title:"Film Festival", date:"2026-01-29", venue:"Egyptian Cinema Hall", price:200, emoji:"🎬"},
    {id:7, title:"tul8te", date:"2026-12-05", venue:"el arena", price:750, emoji:"🎤"}
  ]
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

function addToCart(eventId, qty=1) {
  const event = state.events.find(e => e.id == eventId);
  if (!event) return;
  const existing = state.cart.find(i => i.id == eventId);
  if (existing) {
    existing.qty += qty;
  } else {
    state.cart.push({...event, qty});
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
    <div class="card center" style="flex-direction: column;">
      <div class="event-emoji" style="font-size: 2rem;">${e.emoji}</div>
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
   Form Handling
   =========================== */
function handleLogin(email, password) {
  if (email && password) {
    state.user = {email};
    localStorage.setItem('user', JSON.stringify(state.user));
    window.location.href = "dashboard.php";
  }
}

function handleRegister(name, email, password) {
  if (name && email && password) {
    state.user = {name, email};
    localStorage.setItem('user', JSON.stringify(state.user));
    window.location.href = "dashboard.php";
  }
}

/* ===========================
   Checkout Rendering
   =========================== */
function renderCheckout() {
  const cart = state.cart;
  const summary = document.querySelector('.left .card');
  if (!summary) return;

  summary.innerHTML = cart.map(item => `
    <div class="row" style="justify-content: space-between;">
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
   Page Initializers
   =========================== */

// Detect current page by filename
function getPageName() {
  const path = window.location.pathname;
  return path.substring(path.lastIndexOf('/') + 1);
}

// Dashboard rendering
function renderDashboard() {
  // Show user name if logged in
  const userNameEl = document.getElementById('userName');
  if (userNameEl) {
    if (state.user && state.user.name) {
      userNameEl.textContent = state.user.name;
    } else if (state.user && state.user.email) {
      userNameEl.textContent = state.user.email;
    }
  }

  // Render tickets
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

  // Render orders
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
   Page Loader
   =========================== */
document.addEventListener("DOMContentLoaded", () => {
  const page = getPageName();

  if (page === "index.php") {
    renderEvents();
  }
  if (page === "events.php") {
    renderEvents();
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
});

document.addEventListener("DOMContentLoaded", () => {
  const page = getPageName();

  if (page === "login.php") {
    const form = document.getElementById("loginForm");
    form.addEventListener("submit", e => {
      e.preventDefault();
      const email = document.getElementById("loginEmail").value;
      const password = document.getElementById("loginPassword").value;
      handleLogin(email, password);
    });
  }

  if (page === "register.php") {
  const form = document.getElementById("registerForm");
  form.addEventListener("submit", e => {
    e.preventDefault();
    const name = document.getElementById("registerName").value;
    const email = document.getElementById("registerEmail").value;
    const password = document.getElementById("registerPassword").value;
    const confirmPassword = document.getElementById("registerConfirmPassword").value;

    if (password !== confirmPassword) {
      alert("Passwords do not match!");
      return;
    }

    handleRegister(name, email, password);
  });
}
});