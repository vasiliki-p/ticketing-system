<?php
// Σύνδεση με τη βάση δεδομένων
$servername = "localhost";
$username = "admin";
$password = "B@kal@r05";
$dbname = "register";

// Δημιουργία σύνδεσης
$conn = new mysqli($servername, $username, $password, $dbname);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Λήψη των δεδομένων από το αίτημα AJAX
$id = $_GET['id'];
$completed = $_GET['completed'];

// Ενημέρωση της βάσης δεδομένων
$sql = "UPDATE requests SET completed = $completed WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Η κατάσταση του αιτήματος ενημερώθηκε επιτυχώς.";
} else {
    echo "Error updating record: " . $conn->error;
}

// Κλείσιμο σύνδεσης
$conn->close();
?>
