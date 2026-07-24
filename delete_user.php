<?php
<<<<<<< HEAD
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
=======
include 'delete user.html';
// σύνδεση με τη βάση
$servername = "localhost";
$username = "admin";
$password = "B@kal@r05";
$dbname = "register";

// Δημιουργία σύνδεσης με τη βάση δεδομένων
$conn = new mysqli($servername, $username, $password, $dbname);

// Έλεγχος για τυχόν σφάλματα σύνδεσης
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Διαγραφή</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <link rel="stylesheet" type="text/css" >
</head>
<body>  
<div class="reg-form">
    <h2>Διαγραφή Χρήστη</h2>
    <form id="reg-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <label for="delete_user_name">Όνομα:</label>
        <input type="text" name="delete_user_name" placeholder="Όνομα" required>
        <label for="delete_user_lastname">Επώνυμο:</label>
        <input type="text" name="delete_user_lastname" placeholder="Επώνυμο" required>
        <div style="text-align: center;"> 
        <input type="submit" name="delete_user" value="Διαγραφή">
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        // Κώδικας για καταχώρηση εταιρείας
    }
    
    if (isset($_POST['delete_user'])) {
        // Λαμβάνουμε τον κωδικό και το όνομα της εταιρείας που θέλουμε να διαγράψουμε
        $delete_user_name = $_POST['delete_user_name'];
        $delete_user_lastname = $_POST['delete_user_lastname'];

        // Κατασκευάζουμε το SQL ερώτημα για διαγραφή
        $sql = "DELETE FROM users WHERE name =? AND lastname = ?";


        // Προετοιμάζουμε το ερώτημα SQL για εκτέλεση
        $stmt = $conn->prepare($sql);
        
        // Συνδέουμε τον κωδικό και το όνομα της εταιρείας με τις παραμέτρους στο ερώτημα SQL
        $stmt->bind_param("ss", $delete_user_name, $delete_user_lastname);

        // Εκτελούμε το ερώτημα διαγραφής
        if ($stmt->execute()) {
            echo "Ο χρήστης διαγράφηκε με επιτυχία.";
        } else {
            echo "Σφάλμα κατά τη διαγραφή του χρήστη: " . $stmt->error;
        }

        // Κλείνουμε το statement
        $stmt->close();
    }
}
$conn->close();
?>


</body>
</html>
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
