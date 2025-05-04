<?php
// Ensure correct path to the DB configuration
include_once(__DIR__ . '/config/db.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id']; // Safely cast to integer

    try {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        error_log("Error deleting user with ID $id: " . $e->getMessage());
        echo "An error occurred while deleting the user.";
    }
} else {
    // Invalid or missing ID
    header("Location: index.php");
    exit;
}
?>
