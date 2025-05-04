<?php
// Include the database configuration
include_once('C:/wamp64/www/wamp_project/config/db.php'); // Ensure this path is correct

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate the form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    // Check if both fields are not empty
    if (empty($name) || empty($email)) {
        // Display an error message if fields are empty
        $error = "Both name and email are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Validate the email format
        $error = "Please provide a valid email address.";
    } else {
        // Prepare the SQL query to insert user into the database
        $query = "INSERT INTO users (name, email) VALUES (:name, :email)";
        $stmt = $pdo->prepare($query);
        
        // Execute the query and handle any database errors
        try {
            $stmt->execute(['name' => $name, 'email' => $email]);
            header("Location: index.php");  // Redirect to the homepage after successful insertion
            exit;  // Make sure to exit after the header redirect
        } catch (PDOException $e) {
            $error = "Error occurred while inserting the data: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
</head>
<body>
    <h1>Create User</h1>
    
    <!-- Display error message if any -->
    <?php if (isset($error)): ?>
        <div style="color: red;"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    
    <form method="POST" action="create.php">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br><br>
        <button type="submit">Create</button>
    </form>
    
    <a href="index.php">Back to Home</a>
</body>
</html>
