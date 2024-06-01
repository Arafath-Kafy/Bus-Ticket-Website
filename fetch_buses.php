<?php
// Database connection parameters
$host = "localhost";
$username = "root";
$password = ""; // Default password for XAMPP MySQL
$database = "busticket";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch bus data from the database
$sql = "SELECT * FROM buses";
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<div class='bus-item'>";
        echo "<p>Company Name: " . $row["company_name"] . "</p>";
        echo "<p>Bus Number: " . $row["bus_number"] . "</p>";
        echo "<p>AC Status: " . $row["ac_status"] . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No buses available</p>";
}

// Close database connection
$conn->close();
?>
