
<?php
$servername = "localhost";
$username = "admin";
$password = "B@kal@r05";
$dbname = "register";

// Λήψη του κωδικού εταιρείας από το αίτημα AJAX
$company_code = $_GET['company_code'];

// Δημιουργία σύνδεσης με τη βάση δεδομένων
$conn = new mysqli($servername, $username, $password, $dbname);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Εκτέλεση ερωτήματος SQL για την ανάκτηση του ονόματος της εταιρείας με βάση τον κωδικό
$sql = "SELECT company_name,description FROM company WHERE company_code = '$company_code'";
$result = $conn->query($sql);

// Έλεγχος των αποτελεσμάτων του ερωτήματος
if ($result->num_rows > 0) {
    // Επιστροφή του ονόματος της εταιρείας ως απάντηση AJAX
    $row = $result->fetch_assoc();
    echo $row["company_name"].  " - " . $row["description"];
} else {
    echo " " . $company_code;
}

// Κλείσιμο της σύνδεσης με τη βάση δεδομένων
$conn->close();
?>
