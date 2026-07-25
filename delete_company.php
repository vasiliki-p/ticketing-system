<?php
include 'restricted.php';
include 'connection.php';
include 'delete dep css.html';

if (isset($_GET['company_code'])) {
    $company_code = intval($_GET['company_code']);

    // Prepare statement to delete company
    $sql = "DELETE FROM company WHERE company_code = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $company_code);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Σφάλμα κατά τη διαγραφή της εταιρείας: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Μη έγκυρο αίτημα.";
}
?>
