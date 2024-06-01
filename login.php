<?php
session_start();

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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT username, password, user_type FROM users_data WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($db_username, $db_password, $db_user_type);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && $db_password === $password) {
        // Set session variables upon successful login
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = $db_user_type;

        $response = [
            "success" => true,
            "message" => "Login successful!",
            "redirect" => $db_user_type === "admin" ? "admin_portal.html" : "Home.html"
        ];
    } else {
        $response = [
            "success" => false,
            "message" => "Invalid username or password!"
        ];
    }

    echo json_encode($response);
    $stmt->close();
}

$conn->close();
?>
