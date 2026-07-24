<?php
<<<<<<< HEAD
include 'restricted.php';
include 'connection.php';

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
=======
include 'delete company css.html';
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
    <h2>Διαγραφή Εταιρείας</h2>
    <form id="reg-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <label for="delete_company_code">Κωδικός Εταιρείας:</label>
        <input type="text" name="delete_company_code" placeholder="Κωδικός Εταιρείας" required>
        <label for="delete_company_name">Όνομα Εταιρείας:</label>
        <input type="text" name="delete_company_name" placeholder="Όνομα Εταιρείας" required>
        <div style="text-align: center;"> 
        <input type="submit" name="delete_company" value="Διαγραφή">
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        // Κώδικας για καταχώρηση εταιρείας
    }
    
    if (isset($_POST['delete_company'])) {
        // Λαμβάνουμε τον κωδικό και το όνομα της εταιρείας που θέλουμε να διαγράψουμε
        $delete_company_code = $_POST['delete_company_code'];
        $delete_company_name = $_POST['delete_company_name'];

        // Κατασκευάζουμε το SQL ερώτημα για διαγραφή
        $sql = "DELETE FROM company WHERE company_code=? AND company_name = ?";


        // Προετοιμάζουμε το ερώτημα SQL για εκτέλεση
        $stmt = $conn->prepare($sql);
        
        // Συνδέουμε τον κωδικό και το όνομα της εταιρείας με τις παραμέτρους στο ερώτημα SQL
        $stmt->bind_param("ss", $delete_company_code, $delete_company_name);

        // Εκτελούμε το ερώτημα διαγραφής
        if ($stmt->execute()) {
            echo "Η εταιρεία διαγράφηκε με επιτυχία.";
        } else {
            echo "Σφάλμα κατά τη διαγραφή της εταιρείας: " . $stmt->error;
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
