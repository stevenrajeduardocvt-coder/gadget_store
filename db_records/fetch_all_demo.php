<?php

// Include the database configuration file for connection
require 'dbconfig.php';

// Prepare the SQL query to select all records from the products table
$stmt = $pdo->prepare("SELECT * FROM products");

// Execute the prepared statement
$stmt->execute();

// Use fetchAll() to get all rows as an associative array
$allProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Requirement: Use <pre> tags and print_r() for the display
echo "<h3>Demonstrating FETCH_ALL(): All Products</h3>";
echo "<pre>";
print_r($allProducts);
echo "</pre>";
?>