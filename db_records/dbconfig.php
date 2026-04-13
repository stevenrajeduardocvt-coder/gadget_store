<?php
// Database server settings
$host = "localhost";
$dbname = "gadget_store";
$username = "root";
$password = ""; // Default XAMPP password is empty

try {
    // Establishing a connection using the PDO DSN (Data Source Name)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Setting the error mode to Exception so we can catch database errors easily
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Default fetch mode as associative array for easier data handling
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // If the connection fails, stop the script and display the error message
    die("Database connection failed: " . $e->getMessage());
}
?>
