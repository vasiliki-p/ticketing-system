<?php
session_start();

// Έλεγχος αν έχει υποβληθεί η φόρμα σύνδεσης
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Εκχώρηση του user_id από τη βάση δεδομένων στη συνεδρία
    $_SESSION['user_id'] = $user_id_from_database; // Αντικαταστήστε το με τον τρόπο που ανακτήσατε το user_id από τη βάση δεδομένων
    // Ανακατεύθυνση στην επιθυμητή σελίδα μετά τη σύνδεση
    header("Location: welcome.php");
    exit();
}
?>
