<?php
// Include the database configuration file
include_once('C:/wamp64/www/wamp_project/config/db.php'); // Ensure this path is correct

// Database connection parameters
$host = 'localhost';
$db   = 'wamp_db';
$user = 'root';  // Adjust if you have a different username
$pass = 'admin';      // Adjust if you have a different password (default for WAMP is usually empty)
$charset = 'utf8mb4';

// DSN (Data Source Name) for MySQL connection
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// PDO options for error handling and fetch mode
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    // Create a new PDO instance to connect to the database
    $pdo = new PDO($dsn, $user, $pass, $options);
    // Optionally, you can log success here or initialize some variables for the connection
} catch (\PDOException $e) {
    // Log the error message to a log file (best practice for production)
    error_log("Database connection failed: " . $e->getMessage());
    // Optionally, you can display a user-friendly message or handle the error in another way
    die("Database connection failed. Please try again later.");
}
?>
