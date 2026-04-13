<?php
/**
 * SHOW CODE DEMONSTRATING DELETION OF RECORD TO YOUR DATABASE
 * * This script demonstrates how to remove an existing record from the 'products' table.
 * Like insertion, deletion uses prepared statements to ensure the operation
 * is secure and specifically targets the intended record.
 */

// 1. Include the database configuration file to establish the connection
require_once 'dbconfig.php';

// 2. Define the ID of the product that we want to delete from the database
// For example, we will delete the product with ID 4
$idToDelete = 4;

try {
    // 3. Prepare the SQL DELETE statement with a named placeholder (:id)
    $sql = "DELETE FROM products WHERE product_id = :id";
    
    $stmt = $pdo->prepare($sql);

    // 4. Execute the statement by passing the specific ID to the placeholder
    $success = $stmt->execute(['id' => $idToDelete]);

    // 5. Check if the deletion was successful and provide feedback
    if ($success) {
        echo "<h2>Record Successfully Deleted!</h2>";
        echo "<p>Product with ID: " . $idToDelete . " has been removed from the inventory.</p>";
    } else {
        echo "<p>No record was found with that ID, or the deletion failed.</p>";
    }

} catch (PDOException $e) {
    // 6. Handle errors (e.g., foreign key constraints preventing deletion)
    echo "Deletion Failed: " . $e->getMessage();
}
?>