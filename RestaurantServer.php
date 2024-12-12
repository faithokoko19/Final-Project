<?php
require_once 'restaurantDatabase.php';

class RestaurantPortal {
    private $db;

    public function __construct() {
        $this->db = new RestaurantDatabase();
    }

    public function handleRequest() {
        $action = $_GET['action'] ?? 'home';

        switch ($action) {
            case 'addReservation':
                $this->addReservation();
                break;
            case 'viewReservations':
                $this->viewReservations();
                break;
            default:
                $this->home();
        }
    }

    private function home() {
        include 'templates/home.php';
    }

    private function addReservation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customerId = $_POST['customer_id'];
            $reservationTime = $_POST['reservation_time'];
            $numberOfGuests = $_POST['number_of_guests'];
            $specialRequests = $_POST['special_requests'];

            $this->db->addReservation($customerId, $reservationTime, $numberOfGuests, $specialRequests);
            header("Location: index.php?action=viewReservations&message=Reservation Added");
            exit();
        } else {
            include 'templates/addReservation.php';
        }
    }

    private function viewReservations() {
        $reservations = $this->db->getAllReservations();
        $message = $_GET['message'] ?? '';
        include 'templates/viewReservations.php';
    }

    private function addCustomerForm() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Capture form data
            $customerName = $_POST['customer_name'];
            $contactInfo = $_POST['contact_info'];

            // Call private method to handle customer addition logic
            $this->addCustomer($customerName, $contactInfo);

            // Redirect after customer is added
            header("Location: index.php?action=viewCustomers&message=Customer Added");
            exit();
        } else {
            // Display add customer form
            include 'templates/addCustomer.php';
        }
    }
}

$portal = new RestaurantPortal();
$portal->handleRequest();