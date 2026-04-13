<?php
/**
 * SHOW CODE DEMONSTRATING UPDATING OF RECORD FROM YOUR DATABASE
 * * This script demonstrates how to modify an existing record in the 'products' table.
 * Updating records is a fundamental part of inventory management, such as 
 * changing prices or stock levels after a shipment or sale.
 */

// 1. Include the database configuration file to establish the connection
require_once 'dbconfig.php';

// 2. Define the new data values for the update
$newPrice = 82000.00; // New discounted price for a laptop
$newStock = 10;       // New stock quantity after a restock
$targetProductId = 1; // The ID of the product we want to update

try {
    // 3. Prepare the SQL UPDATE statement with named placeholders
    // We target the record specifically using the product_id
    $sql = "UPDATE products 
            SET price = :price, stock_quantity = :stock 
            WHERE product_id = :id";
    
    $stmt = $pdo->prepare($sql);

    // 4. Execute the statement by passing an associative array of the updated data
    $success = $stmt->execute([
        'price' => $newPrice,
        'stock' => $newStock,
        'id'    => $targetProductId
    ]);

    // 5. Check if the update was successful and provide feedback
    if ($success) {
        echo "<h2>Record Successfully Updated!</h2>";
        echo "<p>Product ID: " . $targetProductId . " has been updated with the new price and stock levels.</p>";
    } else {
        echo "<p>Update failed. Please check if the Product ID exists.</p>";
    }

} catch (PDOException $e) {
    // 6. Handle any errors that occur during the update process
    echo "Update Failed: " . $e->getMessage();
}
?>