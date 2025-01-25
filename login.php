<?php
// Start session
session_start();

// Include database connection
include 'db_connection.php';

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Prepare SQL query to check if email exists
    $stmt = $conn->prepare("SELECT id, full_name, password, user_type FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    // Check if email exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $full_name, $stored_password, $user_type);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $stored_password)) {
            // Set session variables
            $_SESSION['user_id'] = $id;
            $_SESSION['full_name'] = $full_name;
            $_SESSION['email'] = $email;
            $_SESSION['user_type'] = $user_type;

            // Redirect user based on their role
            if ($user_type == 'Farmer') {
                header("Location: organic2.html");
            } else {
                header("Location: organic2.html");
            }
        } else {
            // Incorrect password
            echo "<script>alert('Invalid password. Please try again.'); window.location.href = 'login.php';</script>";
        }
    } else {
        // Email not found
        echo "<script>alert('No account found with that email.'); window.location.href = 'login.php';</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!-- HTML Part for Login Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            padding: 50px;
        }
        .login-form {
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
            <div class="login-form">
                <h2 class="form-title">Login</h2>
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Login</button>
                </form>
                <p class="text-center mt-3">Don't have an account? <a href="registration.php">Register here</a></p>
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
