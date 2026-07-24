<?php
<<<<<<< HEAD
include 'user_id login.php';
include 'connection.php';
include 'myrequests css.html';

// Εκτέλεση ερωτήματος για την ανάκτηση λεπτομερειών των αιτημάτων του χρήστη
$stmt = $conn->prepare("SELECT id, title, request FROM requests WHERE user_id = ? ORDER BY created_at DESC");
=======
session_start();
include 'myrequests css.html';

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
$stmt = $conn->prepare("SELECT id, title, request FROM requests WHERE user_id = ?");
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<div class='reg-form'>";
echo "<h1>Τα Αιτήματά μου</h1>";
// Έλεγχος αποτελεσμάτων
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
<<<<<<< HEAD
        echo "<h2><a href='answer.php?id=" . $row["id"] . "'>" . $row["title"] . "</a></h2>";
    }
} else {
    echo "Δεν βρέθηκαν αιτήματα ";
=======
        echo "<h2><a href='request.php?id=" . $row["id"] . "'>" . $row["title"] . "</a></h2>";
    }
} else {
    echo "Δεν βρέθηκε αίτημα για τον χρήστη με ID: " . $user_id;
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
}
echo "</div>";

// Κλείσιμο αποτελέσματος και σύνδεσης
$stmt->close();
$conn->close();
?>
