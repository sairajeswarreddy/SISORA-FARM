CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vegetable_name VARCHAR(255) NOT NULL,
    quantity DECIMAL(10, 2) NOT NULL,
    price DECIMAL(10, 2) NOT NULL
);
