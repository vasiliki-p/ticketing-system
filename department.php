<?php
<<<<<<< HEAD
include 'restricted.php';
=======
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
include 'dep css.html';
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

echo "\n\n";
//echo "Connected successfully";

?>
<!DOCTYPE html>
<html>
<head>
    <title>Τμήμα</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
</head>
<body> 
    <div class="reg-form ">
        <h2><strong>Καταχώρηση Τμήματος</strong></h2>
        <form id="reg-form" name="DepartmentRegistration" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>"> 
            <p></p>
            <input type="text" id="Όνομα Τμήματος" name="department_name" placeholder="Όνομα Τμήματος" required>
            <p></p>
            <input type="submit" name="submit" value="Καταχώρηση">
        </form>
   
   
   <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['department_name'])){

        // Ανάθεση τιμών από την POST μεταβλητές σε μεταβλητές PHP        
        $department_name = $_POST['department_name'];
        // Ερώτημα για έλεγχο εάν το τμήμα υπάρχει ήδη στη βάση
        $stmt = $conn->prepare("SELECT * FROM department WHERE department_name=? ");
        $stmt->bind_param("s", $department_name);
        $stmt->execute();
        $result = $stmt->get_result();

        // Εισαγωγή στοιχείων τμήματος αν δεν υπάρχει ήδη
        if ($result->num_rows == 0) {
            $stmt = $conn->prepare("INSERT INTO department (department_name) VALUES (?)");
            $stmt->bind_param("s", $department_name);

            if ($stmt->execute()) {
                echo "Επιτυχής δημιουργία νέας εγγραφής";
            } else {
                echo "Error: " . $stmt->error;
            }  
            $stmt->close();
        } else {
            echo "Το τμήμα υπάρχει ήδη";
        }
    }
}
$conn->close();
?>
    <script>
    function updateSelectedItems() {
    var selectedItems = []; // Αρχικοποίηση ενός πίνακα για να αποθηκεύσουμε τα επιλεγμένα στοιχεία 

    // Προσθήκη τιμών από το πεδίο department_name
    var departmentΝameValue = document.getElementById("Όνομα Τμήματος").value.trim();
    if (departmentΝameValue !== "") {
        selectedItems.push(departmentΝameValue);
    }
    
    // Ενημέρωση του κρυφού πεδίου (ή της textarea) με τις επιλεγμένες τιμές
    document.getElementById("selected_items").value = selectedItems.join(", ");
    }

    document.getElementById("Όνομα Τμήματος").addEventListener("input", updateSelectedItems);
    </script>
</div>
</body>
</html>
