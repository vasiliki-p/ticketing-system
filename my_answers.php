<?php
session_start();
include 'myanswers css.html';

// Έλεγχος αν ο χρήστης έχει συνδεθεί
if (!isset($_SESSION['user_id'])) {
    // Αν δεν έχει συνδεθεί, ανακατεύθυνση στη σελίδα σύνδεσης
    header("Location: login.php");
    exit();
}

// Αν έχει συνδεθεί, μπορείτε να χρησιμοποιήσετε το user_id από τη συνεδρία
$user_id = $_SESSION['user_id'];

// Εκτέλεση σύνδεσης με τη βάση δεδομένων
$servername = "localhost";
$username = "admin";
$password = "B@kal@r05";
$dbname = "register";

$conn = new mysqli($servername, $username, $password, $dbname);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die("Αποτυχία σύνδεσης: " . $conn->connect_error);
}

// Εκτέλεση ερωτήματος για την ανάκτηση λεπτομερειών των αιτημάτων του χρήστη
<<<<<<< HEAD
$stmt = $conn->prepare("SELECT id, title FROM requests WHERE user_id = ? AND request != '' ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

=======
$stmt = $conn->prepare("SELECT id, title, request, answer FROM requests WHERE user_id = ? AND answer!='' ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
echo "<div class='reg-form'>";
echo "<h1> Απαντήσεις</h1>";
// Έλεγχος αποτελεσμάτων
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
echo " \n\n";
        echo "<h2><a href='answer.php?id=" . $row["id"] . "'>" . $row["title"] . "</a></h2>";
    }
} else {
    echo "Δεν βρέθηκαν απαντήσεις";
}
echo "</div>";

// Κλείσιμο αποτελέσματος και σύνδεσης
$stmt->close();
$conn->close();
?>
