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
            case 'addCustomer':
                $this->addCustomer();
                break;
            case'viewPreferences':
                $this->viewPreferences();
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

    
    private function addCustomer() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $customerName = $_POST['customer_name'];
            $contactInfo = $_POST['contact_info'];

            
            $this->processAddCustomer($customerName, $contactInfo);

            
            header("Location: index.php?action=viewCustomers&message=Customer Added");
            exit();
        } else {
            
            $this->renderAddCustomerForm();
        }
    }

    
    private function processAddCustomer($customerName, $contactInfo) {
        $this->db->addCustomer($customerName, $contactInfo);
    }

    
    private function renderAddCustomerForm() {
        include 'templates/addCustomer.php';
    }
    private function viewPreferences() {
        
    $customerId = $_GET['customerId'] ?? null; 

    if ($customerId) {
        
        $preferences = $this->db->getCustomerPreferences($customerId);
        $message = $_GET['message'] ?? '';  
        include 'templates/viewPreferences.php';
    } else {
        echo "Please provide a customer ID to view preferences.";
    }
    }
}


$portal = new RestaurantPortal();
$portal->handleRequest();
?>
