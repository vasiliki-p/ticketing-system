<?php
include 'connection.php';


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare the UPDATE statement to clear the answer field and set completed to 0
    $stmt = $conn->prepare("DELETE FROM answers WHERE request_id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
}

// Close connection
$conn->close();
?>
