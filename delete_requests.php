<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare and execute the DELETE statement for requests table
    $stmt_requests = $conn->prepare("DELETE FROM requests WHERE id = ?");
    $stmt_requests->bind_param("i", $id);

    if ($stmt_requests->execute()) {
        // If request deletion is successful, prepare and execute the DELETE statement for answers table
        $stmt_answers = $conn->prepare("DELETE FROM answers WHERE request_id = ?");
        $stmt_answers->bind_param("i", $id);
        
        if ($stmt_answers->execute()) {
            echo "success";
        } else {
            echo "error";
        }

        $stmt_answers->close();
    } else {
        echo "error";
    }

    $stmt_requests->close();
}

// Close connection
$conn->close();
?>
