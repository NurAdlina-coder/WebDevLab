<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['matric'])) {
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

// Handle user deletion
if (isset($_GET['delete'])) {
    $matric = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM users WHERE matric = ?");
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $stmt->close();
}

// Fetch users from the database
$sql = "SELECT matric, name, role FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
</head>
<body>

<h2>User List</h2>

<table border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>Matric</th>
        <th>Name</th>
        <th>Access Level</th>
        <th colspan="2">Actions</th> <!-- Merge two columns for Actions -->
    </tr>

    <?php
    // Check if there are results and output them
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['matric']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['role']) . "</td>";
            echo "<td>
                    <a href='update_user.php?matric=" . htmlspecialchars($row['matric']) . "'>Update</a>
                  </td>";
            echo "<td>
                    <a href='display_users.php?delete=" . htmlspecialchars($row['matric']) . "' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No users found</td></tr>";
    }

    // Close the database connection
    $conn->close();
    ?>
</table>

</body>
</html>