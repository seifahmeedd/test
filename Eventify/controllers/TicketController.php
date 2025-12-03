<?php
require_once __DIR__ . '/../models/Ticket.php';
require_once __DIR__ . '/../models/Event.php';

class TicketController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /* ---------------- USER: VIEW SINGLE TICKET ---------------- */
    public function view($ticketId) {
        $ticket = Ticket::getById($this->conn, $ticketId);

        if (!$ticket) {
            header("Location: tickets.php?action=list&msg=notfound");
            exit;
        }

        // Ownership check
        if (isset($_SESSION['user_id']) && $ticket['user_id'] != $_SESSION['user_id']) {
            header("Location: tickets.php?action=list&msg=forbidden");
            exit;
        }

        include __DIR__ . '/../views/tickets/ticket.php';
    }

    /* ---------------- USER: LIST ALL TICKETS ---------------- */
    public function listTickets($userId) {
        $tickets = Ticket::getByUserId($this->conn, $userId);

        if (empty($tickets)) {
            header("Location: tickets.php?action=list&msg=empty");
            exit;
        }

        include __DIR__ . '/../views/tickets/list.php';
    }

    /* ---------------- USER: VIEW TICKETS BY ORDER ---------------- */
    public function viewByOrder($orderId) {
        $tickets = Ticket::getByOrderId($this->conn, $orderId);

        if (empty($tickets)) {
            header("Location: tickets.php?action=list&msg=orderempty");
            exit;
        }

        include __DIR__ . '/../views/tickets/orderTickets.php';
    }

    /* ---------------- USER: CHECKOUT ---------------- */
    public function checkout($eventId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $quantity = (int)($_POST['quantity'] ?? 1);
            $userId   = $_SESSION['user_id'] ?? null;

            if (!$userId) {
                header("Location: users.php?action=login&msg=loginrequired");
                exit;
            }

            if (Ticket::purchase($this->conn, $eventId, $userId, $quantity)) {
                header("Location: tickets.php?action=confirmation&event_id=$eventId");
                exit;
            } else {
                $error = "Error during checkout.";
                include __DIR__ . '/../views/tickets/checkout.php';
            }
        } else {
            include __DIR__ . '/../views/tickets/checkout.php';
        }
    }

    /* ---------------- USER: CONFIRMATION ---------------- */
    public function confirmation($eventId) {
        $event = Event::getById($this->conn, $eventId);
        include __DIR__ . '/../views/tickets/confirmation.php';
    }

}