<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['matric'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit();
}

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$host = 'localhost';
$db = 'Lab_5b';
$user = 'root';
$pass = '';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$matric = '';
$name = '';
$role = '';

// Handle form submission for update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    // Update user data - ensure you are using the correct matric value
    $stmt = $conn->prepare("UPDATE users SET name = ?, role = ? WHERE matric = ?");
    $stmt->bind_param("ssi", $name, $role, $matric); // Ensure matric is treated as a string
    $stmt->execute();
    $stmt->close();

    // Redirect back to display users
    header('Location: display_users.php');
    exit();
}

// Fetch user data for the given matric number
if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $stmt = $conn->prepare("SELECT name, role FROM users WHERE matric = ?");
    $stmt->bind_param("s", $matric); // Ensure matric is treated as a string
    $stmt->execute();
    $stmt->bind_result($name, $role);
    $stmt->fetch();
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>

<h2>Update User</h2>
<form method="post">
    <label for="matric">Matric:</label>
    <input type="text" name="matric" value="<?php echo htmlspecialchars($matric); ?>" required>
    <br>
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
    <br>
    <label for="role">Access Level:</label>
    <input type="text" name="role" value="<?php echo htmlspecialchars($role); ?>" required>
    <br>
    <input type="submit" value="Update">
    <a href="display_users.php">Cancel</a> <!-- Link to cancel and go back to user list -->
</form>

</body>
</html>