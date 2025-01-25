CREATE DATABASE organic_traceability;
USE organic_traceability;
CREATE TABLE vegetables (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each vegetable entry
    vegetable_name VARCHAR(255) NOT NULL, -- Name of the vegetable
    vegetable_type VARCHAR(255) NOT NULL, -- Type of vegetable (e.g., leafy, root)
    quantity FLOAT NOT NULL, -- Quantity in kg
    harvest_date DATE NOT NULL, -- Harvest date
    organic_certification VARCHAR(255) -- Optional organic certification number
    price NUMERIC NOT NULL --price of the vegetable per kg
);
DESCRIBE vegetables;
