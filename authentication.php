<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $response = [
        "authenticated" => true,
        "user" => [
            "username" => $_SESSION['username'],
            "email" => $_SESSION['email'],
            "user_type" => $_SESSION['user_type']
        ]
    ];
} else {
    $response = [
        "authenticated" => false
    ];
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
