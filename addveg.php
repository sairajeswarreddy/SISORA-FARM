<?php
// Include database connection
include 'db_connection.php';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vegetableName = $_POST['vegetableName'];
    $vegetableType = $_POST['vegetableType'];
    $quantity = $_POST['quantity'];
    $harvestDate = $_POST['harvestDate'];
    $price=$_POST['price'];

    // Insert data into the database
    $sql = "INSERT INTO vegetables (vegetable_name, vegetable_type, quantity, harvest_date,price)
            VALUES ('$vegetableName', '$vegetableType', '$quantity', '$harvestDate', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo "New vegetable added successfully!";
        // Redirect to the available vegetables page
        header("Location: availveg.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vegetables</title>
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
        <h2 class="text-center">Add Vegetables</h2>
        <form action="addveg.php" method="POST">
            <div class="form-group">
                <label for="vegetableName">Vegetable Name:</label>
                <input type="text" name="vegetableName" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="vegetableType">Vegetable Type:</label>
                <input type="text" name="vegetableType" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity (kg):</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="harvestDate">Harvest Date:</label>
                <input type="date" name="harvestDate" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price">price(kg):</label>
                <input type="number" name="price" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Add Vegetable</button>
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
