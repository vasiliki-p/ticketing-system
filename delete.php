<?php
// Database connection parameters
$servername = "localhost";
$username = "admin";
$password = "B@kal@r05";
$dbname = "register";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user ID is set and not empty
if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
    // Prepare a DELETE statement
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $_GET['user_id']);

    // Execute the statement
    if ($stmt->execute()) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "User ID not provided.";
}

// Close the connection
$conn->close();
?>
