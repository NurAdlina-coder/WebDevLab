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
$host = 'localhost';  // Host name
$db = 'Lab_5b';       // Database name
$user = 'root';       // Database username 
$pass = '';           // Database password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error message variable
$error = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT password FROM users WHERE matric = ?");
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Successful login, set session variable
            $_SESSION['matric'] = $matric;
            header('Location: display_users.php'); // Redirect to user display page
            exit();
        } else {
            // Invalid password
            $error = "Invalid username or password, try <a href='login.php'>login</a> again.";
        }
    } else {
        // No user found
        $error = "Invalid username or password, try <a href='login.php'>login</a> again.";
    }

    // Close statement
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
    <title>Login</title>
</head>
<body>

<h2>Login</h2>
<?php if (!empty($error)): ?>
    <div style="color: red;"><?php echo $error; ?></div>
<?php endif; ?>
<form method="post">
    <input type="text" name="matric" placeholder="Matric Number" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" value="Login">
</form>
<p><a href="lab5b.html">Register</a> here, if you have not.</p>

</body>
</html>