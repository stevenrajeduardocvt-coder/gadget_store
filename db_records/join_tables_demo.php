<?php
/**
 * SHOW CODE DEMONSTRATING JOINING OF THREE OR MORE TABLES FROM THE DATABASE
 * * This script demonstrates a complex SQL JOIN operation involving:
 * 1. users - To get the name of the customer
 * 2. orders - To link the user to their specific order
 * 3. order_items - To see the specific products and quantities in that order
 */

// 1. Include the database configuration file for connectivity
require_once 'dbconfig.php';

try {
    /**
     * 2. SQL Query string joining three tables:
     * - users (u)
     * - orders (o) on user_id
     * - order_items (oi) on order_id
     */
    $sql = "SELECT 
                u.username, 
                o.order_id, 
                o.order_date, 
                oi.product_id, 
                oi.quantity, 
                oi.unit_price
            FROM users u
            JOIN orders o ON u.user_id = o.user_id
            JOIN order_items oi ON o.order_id = oi.order_id";

    // 3. Prepare the statement
    $stmt = $pdo->prepare($sql);

    // 4. Execute the query
    $stmt->execute();

    // 5. Fetch all results as an associative array
    $orderSummary = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 6. REQUIREMENT: Output the result using print_r() inside <pre> tags
    echo "<h2>Order Summary (Joined Users, Orders, and Items)</h2>";
    echo "<pre>";
    print_r($orderSummary);
    echo "</pre>";

} catch (PDOException $e) {
    // Handle any SQL or connection errors
    echo "Query Error: " . $e->getMessage();
}
?>