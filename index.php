<?php
// Include the RestaurantServer class
require_once 'RestaurantServer.php';

// Instantiate and handle the request
$portal = new RestaurantPortal();
$portal->handleRequest();
?>
