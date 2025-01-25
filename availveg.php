<?php
// Include database connection
include 'db_connection.php';

// Fetch data from the database
$sql = "SELECT * FROM vegetables";
$result = $conn->query($sql);

// Handle 'Add to Cart' functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $veg_name = $_POST['veg_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    // Insert into cart table
    $cart_sql = "INSERT INTO cart (vegetable_name, quantity, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($cart_sql);
    $stmt->bind_param("sid", $veg_name, $quantity, $price);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success text-center'>Added to cart successfully</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error adding to cart: " . $conn->error . "</div>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Vegetables</title>
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
        <h2 class="text-center text-success">Available Vegetables</h2>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">' . htmlspecialchars($row['vegetable_name']) . '</h5>
                            <p class="card-text">
                                <strong>Type:</strong> ' . htmlspecialchars($row['vegetable_type']) . '<br>
                                <strong>Quantity:</strong> ' . htmlspecialchars($row['quantity']) . ' kg<br>
                                <strong>Harvest Date:</strong> ' . htmlspecialchars($row['harvest_date']) . '<br>
                                <strong>Price (kg):</strong> ' . htmlspecialchars($row['price']) . ' Rs<br>
                            </p>
                            <form method="POST" action="">
                                <input type="hidden" name="veg_name" value="' . htmlspecialchars($row['vegetable_name']) . '">
                                <input type="hidden" name="quantity" value="' . htmlspecialchars($row['quantity']) . '">
                                <input type="hidden" name="price" value="' . htmlspecialchars($row['price']) . '">
                                <button type="submit" class="btn btn-primary">Buy</button>
                            </form>
                        </div>
                      </div>';
            }
        } else {
            echo '<p class="text-center">No vegetables available.</p>';
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
</html>
