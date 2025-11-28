<?php
require_once __DIR__ . '/../models/Ticket.php';

class TicketController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /* ---------------- USER: VIEW SINGLE TICKET ---------------- */
    public function view($ticketId) {
        $ticket = Ticket::getById($this->conn, $ticketId);

        if (!$ticket) {
            $error = "Ticket not found.";
            include __DIR__ . '/../views/error.php';
            return;
        }

        // Optional: check ownership
        if (isset($_SESSION['user_id']) && $ticket['user_id'] != $_SESSION['user_id']) {
            $error = "You do not have permission to view this ticket.";
            include __DIR__ . '/../views/error.php';
            return;
        }

        include __DIR__ . '/../views/tickets/ticket.php';
    }

    /* ---------------- USER: VIEW TICKETS BY ORDER ---------------- */
   /* public function viewByOrder($orderId) {
        $tickets = Ticket::getByOrderId($this->conn, $orderId);

        if (empty($tickets)) {
            $error = "No tickets found for this order.";
            include __DIR__ . '/../views/error.php';
            return;
        }

        include __DIR__ . '/../views/tickets/orderTickets.php';
    }*/
}