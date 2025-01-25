<?php
// Include database connection
include 'db_connection.php';

// Fetch data from the cart table
$sql = "SELECT * FROM cart";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
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
        <h2 class="text-center text-success">Cart</h2>
        <?php
        if ($result->num_rows > 0) {
            echo '<table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Vegetable Name</th>
                            <th>Quantity (kg)</th>
                            <th>Price (Rs)</th>
                        </tr>
                    </thead>
                    <tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                        <td>' . htmlspecialchars($row['vegetable_name']) . '</td>
                        <td>' . htmlspecialchars($row['quantity']) . '</td>
                        <td>' . htmlspecialchars($row['price']) . '</td>
                      </tr>';
            }
            echo '</tbody></table>';

            // Add a payment button
            echo '<div class="text-center mt-4">
                    <form action="payment.php" method="post">
                        <button type="submit" class="btn btn-success">Proceed to Payment</button>
                    </form>
                  </div>';
        } else {
            echo '<p class="text-center">Your cart is empty.</p>';
        }

        // Close connection
        $conn->close();
        ?>
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
</body>
</html>
