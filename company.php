<?php
<<<<<<< HEAD
include 'restricted.php';
=======
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
include 'company css.html';
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

//echo "\n\n";
//echo "Connected successfully";
?>


<!DOCTYPE html>
<html>
<head>
    <title>Εταιρεία</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <link rel="stylesheet" type="text/css" >
</head>
<body>  
    <div class="reg-form">
        <h2>Καταχώρηση Εταιρείας</h2>
        <form id="reg-form" name="companyRegistration" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>"> 
            <label for="company_code">Κωδικός Εταιρείας:</label>
            <input type="text" id="Κωδικός Εταιρείας" name="company_code" placeholder="Κωδικός Εταιρείας" required>
            <p></p>
            <label for="company_name">Όνομα Εταιρείας:</label>
            <input type="text" id="Όνομα Εταιρείας" name="company_name" placeholder="Όνομα Εταιρείας" required>
            <p></p>
            <textarea id="selected_items" name="selected_items" rows="4" cols="50" readonly></textarea>
            <p></p>
            <div style="text-align: center;"> 
            <input type="submit" name="submit" value="Καταχώρηση">
            </div>
        </form>
</div>

  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['company_code'],$_POST['company_name'])){

        // Ανάθεση τιμών από την POST μεταβλητές σε μεταβλητές PHP 
        $company_code = $_POST['company_code'];
        $company_name = $_POST['company_name'];
     //   $description= $_POST['description'];



        // Ερώτημα για έλεγχο εάν η εταιρεία υπάρχει ήδη στη βάση
        $stmt = $conn->prepare("SELECT * FROM company WHERE company_code=? OR company_name=? ");
        $stmt->bind_param("ss", $company_code,$company_name);
        $stmt->execute();
        $result = $stmt->get_result();

        // Εισαγωγή στοιχείων εταιρείας αν δεν υπάρχει ήδη
        if ($result->num_rows == 0) {
            $stmt = $conn->prepare("INSERT INTO company (company_code, company_name) VALUES (?, ?)");
            $stmt->bind_param("ss", $company_code,$company_name);

            if ($stmt->execute()) {
                echo "Επιτυχής δημιουργία νέας εγγραφής";
            } else {
                echo "Error: " . $stmt->error;
            }  
            $stmt->close();
        } else {
            echo "Η εταιρεία υπάρχει ήδη";
        }
    }
}
$conn->close();

?>
    <script>
    function updateSelectedItems() {
    var selectedItems = []; // Αρχικοποίηση ενός πίνακα για να αποθηκεύσουμε τα επιλεγμένα στοιχεία

    // Προσθήκη τιμών από το πεδίο company_code
    var companyCodeValue = document.getElementById("Κωδικός Εταιρείας").value.trim();
    if (companyCodeValue !== "") {
        selectedItems.push(companyCodeValue);
    }

    // Προσθήκη τιμών από το πεδίο company_name
    var companyNameValue = document.getElementById("Όνομα Εταιρείας").value.trim();
    if (companyNameValue !== "") {
        selectedItems.push(companyNameValue);
    }

 
    // Ενημέρωση της textarea με τις επιλεγμένες τιμές
    document.getElementById("selected_items").value = selectedItems.join(", ");
}


document.getElementById("Κωδικός Εταιρείας").addEventListener("input", updateSelectedItems);
document.getElementById("Όνομα Εταιρείας").addEventListener("input", updateSelectedItems);

</script>

</body>
</html>

