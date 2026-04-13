<?php
/**
 * SHOW CODE DEMONSTRATING JOINING OF THREE OR MORE TABLES FROM THE DATABASE WITH FILTERING CONDITION
 * * This script demonstrates a complex SQL JOIN operation with a WHERE clause.
 * Tables involved:
 * 1. products (p) - To get product details
 * 2. categories (c) - To identify the category of the product
 * 3. order_items (oi) - To link products to specific order records
 */

// 1. Include the database configuration file for connectivity
require_once 'dbconfig.php';

try {
    /**
     * 2. SQL Query string joining three tables:
     * - order_items (oi)
     * - products (p) on product_id
     * - categories (c) on category_id
     * * FILTERING CONDITION: unit_price > 5000
     */
    $sql = "SELECT 
                p.product_name, 
                c.category_name, 
                oi.quantity, 
                oi.unit_price
            FROM order_items oi
            JOIN products p ON oi.product_id = p.product_id
            JOIN categories c ON p.category_id = c.category_id
            WHERE oi.unit_price > 5000";

    // 3. Prepare the statement
    $stmt = $pdo->prepare($sql);

    // 4. Execute the query
    $stmt->execute();

    // 5. Fetch all the filtered results as an associative array
    $filteredOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 6. REQUIREMENT: Output the result using print_r() inside <pre> tags
    echo "<h2>High-Value Items (Filtered Join: Price > 5,000 PHP)</h2>";
    echo "<pre>";
    print_r($filteredOrders);
    echo "</pre>";

} catch (PDOException $e) {
    // Handle any SQL errors
    echo "Error: " . $e->getMessage();
}
?>