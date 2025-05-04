<?php
// Include the database configuration
include_once('C:/wamp64/www/wamp_project/config/db.php'); // Ensure this path is correct

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id']; // Cast the id to an integer for safety
    
    try {
        // Prepare the DELETE query
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $pdo->prepare($query);
        
        // Execute the query
        $stmt->execute(['id' => $id]);
        
        // Redirect to index.php after successful deletion
        header("Location: index.php");
        exit;  // Ensure the script stops executing after the redirect
    } catch (PDOException $e) {
        // Log the error message and optionally display a user-friendly message
        error_log("Error deleting user with ID $id: " . $e->getMessage());
        die("Error occurred while deleting the user. Please try again later.");
    }
} else {
    // If no valid ID is provided, redirect to the homepage
    header("Location: index.php");
    exit;
}
?>
