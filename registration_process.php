<?php
// registration_process.php

// Include database connection file
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get input values from the form
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type']; // New field for user type

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare SQL statement to insert user data
    $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, user_type) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $full_name, $email, $hashed_password, $user_type);

    if ($stmt->execute()) {
        // Success message and redirect to login page
        echo "<script>alert('Registration successful! Please log in.'); window.location.href = 'login.html';</script>";
    } else {
        // Error message
        echo "<script>alert('Registration failed. Please try again later.'); window.location.href = 'registration.html';</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
