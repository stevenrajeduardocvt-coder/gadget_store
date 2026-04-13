<?php
/**
 * SHOW CODE DEMONSTRATING INSERTION OF RECORD TO YOUR DATABASE
 * * This script demonstrates how to add a new product into the 'products' table.
 * It uses prepared statements with named placeholders to prevent SQL injection,
 * which is a best practice in Software Engineering.
 */

// 1. Include the database configuration file to establish the connection
require_once 'dbconfig.php';

// 2. Define the data for the new product to be inserted
$productName = 'Razer Viper V2 Pro';
$categoryId = 2; // Category ID for 'Peripherals'
$productPrice = 7999.00;
$stockQuantity = 12;

try {
    // 3. Prepare the SQL INSERT statement with named placeholders
    $sql = "INSERT INTO products (product_name, category_id, price, stock_quantity) 
            VALUES (:name, :cat_id, :price, :stock)";
    
    $stmt = $pdo->prepare($sql);

    // 4. Execute the statement by passing an associative array of data
    $success = $stmt->execute([
        'name'  => $productName,
        'cat_id' => $categoryId,
        'price' => $productPrice,
        'stock' => $stockQuantity
    ]);

    // 5. Check if the insertion was successful and provide feedback
    if ($success) {
        echo "<h2>New Record Successfully Inserted!</h2>";
        echo "<p>Product: " . htmlspecialchars($productName) . " has been added to the inventory.</p>";
        
        // Optional: Show the ID of the last inserted record
        echo "<p>New Product ID: " . $pdo->lastInsertId() . "</p>";
    }

} catch (PDOException $e) {
    // Handle any errors that occur during the insertion process
    echo "Insertion Failed: " . $e->getMessage();
}
?>