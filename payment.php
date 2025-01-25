<?php
// Include database connection
include 'db_connection.php';

// Initialize variables to avoid undefined index warnings
$name = $phone = $address = $payment_method = '';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize input data to prevent undefined array key warnings
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
    $address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';
    $payment_method = isset($_POST['payment_method']) ? htmlspecialchars($_POST['payment_method']) : '';

    // Insert delivery address into delivery table if all fields are filled
    if ($name && $phone && $address && $payment_method) {
        $sql = "INSERT INTO delivery (name, phone, address, payment_method) VALUES ('$name', '$phone', '$address', '$payment_method')";
        
        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success">Your order has been placed successfully!</div>';
        } else {
            echo '<div class="alert alert-danger">Error: ' . $conn->error . '</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Please fill in all fields.</div>';
    }
    
    // Close the connection after the query
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
        }
        .navbar {
            background-color: #2c9c4e;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        footer {
            background-color: #2c9c4e;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>

 <!-- Navigation Bar -->
 <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Organic Traceability</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                    <a class="btn btn-outline-light mr-2" href="organic2.html">Home</a>
                </li>
                
                <li class="nav-item">
                    <a class="btn btn-outline-light mr-2" href="addveg.php">Add Vegetable</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light" href="availveg.php">Available Vegetables</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light" href="cart1.php">Cart</a>
                </li>
            </ul>
        </div>
    </nav>
<body>
    <div class="container mt-5">
        <h2 class="text-center text-success">Payment Options</h2>
        
        <form action="payment.php" method="POST">
            <!-- Delivery Address Form -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?= $phone ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Delivery Address:</label>
                <textarea class="form-control" id="address" name="address" rows="4" required><?= $address ?></textarea>
            </div>
            
            <!-- Payment Method Options -->
            <h5>Select Payment Method:</h5>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_method" id="phonepe" value="PhonePe" <?= ($payment_method == 'PhonePe') ? 'checked' : '' ?> required>
                <label class="form-check-label" for="phonepe">
                    PhonePe
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_method" id="gpay" value="Google Pay" <?= ($payment_method == 'Google Pay') ? 'checked' : '' ?> required>
                <label class="form-check-label" for="gpay">
                    Google Pay
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_method" id="paytm" value="Paytm" <?= ($payment_method == 'Paytm') ? 'checked' : '' ?> required>
                <label class="form-check-label" for="paytm">
                    Paytm
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_method" id="cash_on_delivery" value="Cash on Delivery" <?= ($payment_method == 'Cash on Delivery') ? 'checked' : '' ?> required>
                <label class="form-check-label" for="cash_on_delivery">
                    Cash on Delivery
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_method" id="credit_debit_card" value="Credit/Debit Card" <?= ($payment_method == 'Credit/Debit Card') ? 'checked' : '' ?> required>
                <label class="form-check-label" for="credit_debit_card">
                    Credit/Debit Card
                </label>
            </div>
            
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-success btn-block">Submit Order</button>
            </div>
        </form>
    </div>
         <!-- Footer -->
         <footer>
        <p>&copy; 2024 Organic Food Traceability | Promoting sustainable farming with technology</p>
    </footer>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
