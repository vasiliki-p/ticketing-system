<?php
include 'connection.php'; 
include 'delete dep css.html';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM requests WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No ID provided";
}

$conn->close();
?>
