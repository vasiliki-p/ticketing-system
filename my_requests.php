<?php
include 'user_id login.php';
include 'connection.php';
include 'myrequests css.html';

// Εκτέλεση ερωτήματος για την ανάκτηση λεπτομερειών των αιτημάτων του χρήστη
$stmt = $conn->prepare("SELECT id, title, request FROM requests WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<div class='reg-form'>";
echo "<h1>Τα Αιτήματά μου</h1>";
// Έλεγχος αποτελεσμάτων
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h2><a href='answer.php?id=" . $row["id"] . "'>" . $row["title"] . "</a></h2>";
    }
} else {
    echo "Δεν βρέθηκαν αιτήματα ";
}
echo "</div>";

// Κλείσιμο αποτελέσματος και σύνδεσης
$stmt->close();
$conn->close();
?>
