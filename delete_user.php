<?php
include 'restricted.php';
include 'connection.php';

if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);

    // Prepare statement to delete user
    $sql = "DELETE FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Σφάλμα κατά τη διαγραφή του χρήστη: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Μη έγκυρο αίτημα.";
}
?>
