<?php
/**
 * SHOW CODE DEMONSTRATING HOW FETCH() IS USED
 * * This script demonstrates retrieving a single record from the database.
 * Unlike fetchAll(), which gets everything, fetch() is used when you
 * only need one specific row (like a specific user or product).
 */

// 1. Include the database configuration file to establish the connection
require_once 'dbconfig.php';

// 2. Define the ID of the specific record we want to retrieve
// In this case, we are looking for the user with ID 1
$searchId = 1;

try {
    // 3. Prepare the SQL statement with a named placeholder (:id) for security
    $sql = "SELECT user_id, username, email, role, date_joined FROM users WHERE user_id = :id";
    $stmt = $pdo->prepare($sql);

    // 4. Execute the statement by passing the actual ID value
    $stmt->execute(['id' => $searchId]);

    // 5. Use fetch() to retrieve the single row as an associative array
    $singleUser = $stmt->fetch(PDO::FETCH_ASSOC);

    // 6. REQUIREMENT: Output the result using print_r() wrapped in <pre> tags for formatting
    echo "<h2>Single User Data Retrieval</h2>";
    echo "<pre>";
    print_r($singleUser);
    echo "</pre>";

} catch (PDOException $e) {
    // Handle potential errors
    echo "Error: " . $e->getMessage();
}
?>