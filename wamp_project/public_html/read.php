<?php
// Include database connection
include_once('C:/wamp64/www/wamp_project/config/db.php'); // Ensure this path is correct

try {
    // Example: Read all records from a table named 'users'
    $stmt = $pdo->query("SELECT * FROM users");

    // Check if any records were returned
    if ($stmt->rowCount() > 0) {
        // Fetch and display the results
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div>";
            echo "<strong>ID:</strong> " . htmlspecialchars($row['id']) . "<br>";
            echo "<strong>Name:</strong> " . htmlspecialchars($row['name']) . "<br>";
            echo "<strong>Email:</strong> " . htmlspecialchars($row['email']) . "<br>";
            echo "</div><hr>";
        }
    } else {
        echo "No users found.";
    }
} catch (PDOException $e) {
    // Log the error and display a generic message
    error_log("Database query error: " . $e->getMessage());
    echo "An error occurred while fetching the data. Please try again later.";
}
?>
