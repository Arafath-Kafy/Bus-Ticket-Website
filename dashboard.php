<?php
// dashboard.php

$host = "localhost";
$username = "root";
$password = ""; // Default password for XAMPP MySQL
$database = "bus_ticket";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data
$bookings = $conn->query("SELECT COUNT(*) as count FROM bookings")->fetch_assoc()['count'];
$buses = $conn->query("SELECT COUNT(*) as count FROM buses")->fetch_assoc()['count'];
$available_seats = $conn->query("SELECT SUM(available_seats) as count FROM buses")->fetch_assoc()['count'];
$booked_seats = $conn->query("SELECT SUM(booked_seats) as count FROM buses")->fetch_assoc()['count'];
$customers = $conn->query("SELECT COUNT(*) as count FROM customers")->fetch_assoc()['count'];
$total_amount = $conn->query("SELECT SUM(amount) as total FROM tickets")->fetch_assoc()['total'];

$conn->close();

?>

<div class="dashboard">
  <h2>Dashboard</h2>
  <ul>
    <li>Number of bookings: <?php echo $bookings; ?></li>
    <li>Number of buses: <?php echo $buses; ?></li>
    <li>Available seats: <?php echo $available_seats; ?></li>
    <li>Booked seats: <?php echo $booked_seats; ?></li>
    <li>Number of customers: <?php echo $customers; ?></li>
    <li>Total sold ticket amount: <?php echo $total_amount; ?></li>
  </ul>
</div>
