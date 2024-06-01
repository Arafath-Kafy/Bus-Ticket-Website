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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirmPassword = $conn->real_escape_string($_POST['confirm-password']);

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "Passwords do not match";
        exit();
    }

    // Check if email already exists
    $checkEmailQuery = "SELECT * FROM users_data WHERE email='$email'";
    $checkEmailResult = $conn->query($checkEmailQuery);
    if ($checkEmailResult) {
        if ($checkEmailResult->num_rows > 0) {
            echo "Email already exists";
            exit();
        }
    } else {
        echo "Error checking email: " . $conn->error;
        exit();
    }

    // Insert user data into database
    $insertQuery = "INSERT INTO users_data (username, email, password, user_type) VALUES ('$username', '$email', '$password', 'user')";
    if ($conn->query($insertQuery) === TRUE) {
        // Redirect to login page after successful registration
        header("Location: login.html");
        exit();
    } else {
        echo "Error registering user: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
