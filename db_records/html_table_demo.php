<?php
/**
 * SHOW CODE DEMONSTRATING AN SQL QUERY’S RESULT SET IS RENDERED ON AN HTML TABLE
 * * This script demonstrates the final step of a system: displaying data to the user.
 * It fetches the current inventory from the 'products' table and loops through 
 * the results to populate a standard HTML <table>.
 */

// 1. Include the database configuration file to establish the connection
require_once 'dbconfig.php';

try {
    // 2. Prepare and execute the SQL query to select relevant product data
    $sql = "SELECT product_name, price, stock_quantity FROM products";
    $stmt = $pdo->query($sql);

    // 3. Fetch all records as an associative array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gadget Store Inventory</title>
    <style>
        /* Simple styling for the midterm demonstration */
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px 0;
            font-family: Arial, sans-serif;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 12px;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #fafafa;
        }
    </style>
</head>
<body>

    <h2>Current Product Inventory</h2>

    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price (PHP)</th>
                <th>Available Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($products) > 0): ?>
                <?php 
                // 4. Iterate through the result set and render each row in the table
                foreach ($products as $row): 
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                        <td><?php echo number_format($row['price'], 2); ?></td>
                        <td><?php echo $row['stock_quantity']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No products found in the inventory.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>