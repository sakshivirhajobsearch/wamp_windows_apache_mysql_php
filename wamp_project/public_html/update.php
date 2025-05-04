<?php
// Include database connection
include_once('C:/wamp64/www/wamp_project/config/db.php'); // Ensure this path is correct

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    // Check for valid input
    if (empty($name) || empty($email)) {
        $error = "Name and email are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please provide a valid email address.";
    } else {
        // Attempt to update the user in the database
        try {
            $query = "UPDATE users SET name = :name, email = :email WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['name' => $name, 'email' => $email, 'id' => $id]);
            header("Location: index.php");  // Redirect to the homepage after successful update
            exit;  // Make sure the script stops after the redirect
        } catch (PDOException $e) {
            $error = "Error occurred while updating the user: " . $e->getMessage();
        }
    }
}

// Check if the 'id' is provided and is valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Attempt to retrieve the user details from the database
    $query = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // If the user doesn't exist, redirect to the homepage
    if (!$user) {
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    
    <!-- Display error message if there's any -->
    <?php if (isset($error)): ?>
        <div style="color: red;"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    
    <form method="POST" action="update.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']); ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']); ?>" required>
        <br><br>
        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
        <br><br>
        <button type="submit">Update</button>
    </form>
    
    <a href="index.php">Back to Home</a>
</body>
</html>
