<?php
// Include database connection file
include 'db_connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If the form is submitted, process the data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate user inputs
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format'); window.location.href = 'organic2.html';</script>";
        exit();
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare SQL statement to check if the email already exists
    $check_email_query = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_email_query);
    if (!$stmt) {
        die("Prepared statement failed: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // If email already exists, display an error
    if ($stmt->num_rows > 0) {
        echo "<script>alert('Email already registered. Please use a different email.'); window.location.href = 'registration.php';</script>";
    } else {
        // Prepare SQL statement to insert user data
        $insert_query = "INSERT INTO users (full_name, email, password, user_type) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        if (!$stmt) {
            die("Prepared statement failed: " . $conn->error);
        }
        $stmt->bind_param("ssss", $full_name, $email, $hashed_password, $user_type);

        // Execute the insert query
        if ($stmt->execute()) {
            // Redirect to login page after successful registration
            echo "<script>alert('Registration successful! Please log in.'); window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('Registration failed. Please try again later.'); window.location.href = 'registration.php';</script>";
        }
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            padding: 50px;
        }
        .registration-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-title {
            text-align: center;
            margin-bottom: 20px;
            color: #2c9c4e;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="registration-form">
                <h2 class="form-title">Register</h2>
                <form action="registration.php" method="POST">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Enter your full name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="form-group">
                        <label for="userType">User Type</label>
                        <select class="form-control" id="userType" name="user_type" required>
                            <option value="Farmer">Farmer</option>
                            <option value="Customer">Customer</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Register</button>
                </form>
                <p class="text-center mt-3">Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
