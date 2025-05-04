<?php
// Include database connection
include_once('C:/wamp64/www/wamp_project/config/db.php'); // Ensure this path is correct

// Initialize the users array
$users = [];

try {
    // Example SQL query to get all users from the database
    $stmt = $pdo->query("SELECT * FROM users"); // Replace 'your_table_name' with the actual table name
    
    // Fetch all rows from the query result and store in the $users array
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WAMP CRUD Application</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>WAMP CRUD Application</h1>
    <a href="create.php">Create New User</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td>
                    <a href="update.php?id=<?php echo htmlspecialchars($user['id']); ?>">Edit</a> |
                    <a href="delete.php?id=<?php echo htmlspecialchars($user['id']); ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
