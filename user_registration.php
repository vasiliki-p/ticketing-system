<?php
<<<<<<< HEAD
include 'restricted.php';
include 'user css.html';
include 'connection.php';

=======
include 'user css.html';
// Database connection parameters
$servername = "localhost";
$username = "admin";
$password = "B@kal@r05";
$dbname = "register";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all necessary fields are set
    if (isset($_POST['name'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['phone'], $_POST['company_code'], $_POST['department_name'], $_POST['role_name'])) {
        
        // Hash the password
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        // Extract values from POST
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $company_code = isset($_POST['company_code']) ? implode(',', $_POST['company_code']) : '';
        $department_name = isset($_POST['department_name']) ? implode(',', $_POST['department_name']) : '';
        $role_name = isset($_POST['role_name']) ? implode(',', $_POST['role_name']) : '';
        
        // Check if admin checkbox is checked
        $admin = isset($_POST['admin']) ? 1 : 0; // Default to 0 if admin checkbox is not checked

        // Check if the user already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=? OR email=?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close(); // Close the statement

        // If user doesn't exist, insert user
        if ($result->num_rows == 0) {
            // Insert user query
            $stmt = $conn->prepare("INSERT INTO users (name, lastname, username, email, password, phone, company_code, department_name, role_name, admin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssssi", $name, $lastname, $username, $email, $password, $phone, $company_code, $department_name, $role_name, $admin);
            
            if ($stmt->execute()) {
                echo "Επιτυχής δημιουργία νέας εγγραφής";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close(); // Close the statement
        } else {
            echo "Ο χρήστης υπάρχει ήδη";
        }
    } else {
        echo "Λείπουν κάποια απαραίτητα πεδία";
    }
}

// Ανάκτηση δεδομένων για dropdown με τα ονόματα τμημάτων
$options_company = "";//αρχικοποιηση
$sql_company = "SELECT company_code FROM company";//επιλογη απο βαση
$result_company = $conn->query($sql_company);//τρεχουμε το πανω ερωτημα στη βαση και φερνουμε το αποτελεσμα που το αποθηκευουμε στο result_company
if ( $result_company->num_rows > 0) {//αν υπαρχουν αποτελεσματα
    while ($row = $result_company->fetch_assoc()) {//γεμισε τη λίστα με όσα αποτελέσματα φερει το result_company
        $options_company .= "<option value='" . $row["company_code"] . "'>" . $row["company_code"] . "</option>";//εμφανιση στη ντροπνταουν λιστα
    }
} else {
    echo "Error fetching company data: " . $conn->error;//λαθος , δεν υπαρχουν αποτελεσματα
}


$options_company2 = "";//αρχικοποιηση
$sql_company2 = "SELECT company_name,description FROM company";//επιλογη απο βαση
$result_company2 = $conn->query($sql_company2);//τρεχουμε το πανω ερωτημα στη βαση και φερνουμε το αποτελεσμα που το αποθηκευουμε στο result_company2
if ( $result_company2->num_rows > 0) {//αν υπαρχουν αποτελεσματα
    while ($row = $result_company2->fetch_assoc()) {//γεμισε τη λίστα με όσα αποτελέσματα φερει το result_company2
        $options_company2 .= "<option value='" . $row["company_name"] . "'>" . $row["company_name"] .  " - " . $row["description"] . "</option>";//εμφανιση στη ντροπνταουν λιστα
    }
} else {
    echo "Error fetching company data: " . $conn->error;//λαθος , δεν υπαρχουν αποτελεσματα
}

// Ανάκτηση δεδομένων για dropdown με τα ονόματα τμημάτων
$options_dep = "";//αρχικοποιηση
$sql_dep = "SELECT department_name FROM department";//επιλογη απο βαση
$result_dep= $conn->query($sql_dep);//τρεχουμε το πανω ερωτημα στη βαση και φερνουμε το αποτελεσμα που το αποθηκευουμε στο result_dep
if ( $result_dep->num_rows > 0) {//αν υπαρχουν αποτελεσματα
    while ($row = $result_dep->fetch_assoc()) {//γεμισε τη λίστα με όσα αποτελέσματα φερει το result_dep
        $options_dep .= "<option value='" . $row["department_name"] . "'>" . $row["department_name"] . "</option>";//εμφανιση στη ντροπνταουν λιστα
    }
} else {
    echo "Error fetching company data: " . $conn->error;//λαθος , δεν υπαρχουν αποτελεσματα
}

// Ανάκτηση δεδομένων για dropdown με τους διαθέσιμους ρόλους
$options_role_name = "";//αρχικοποιηση
$sql_role_name = "SELECT role_name FROM roles";//επιλογη απο βαση
$result_role_name = $conn->query($sql_role_name);//τρεχουμε το πανω ερωτημα στη βαση και φερνουμε το αποτελεσμα που το αποθηκευουμε στο result_role
if ($result_role_name->num_rows > 0) {//αν υπαρχουν αποτελεσματα
    while ($row = $result_role_name->fetch_assoc()) {//γεμισε τη λίστα με όσα αποτελέσματα φερει το result_dep
        $options_role_name .= "<option value='" . $row["role_name"] . "'>" . $row["role_name"] ."</option>";//εμφανιση στη ντροπνταουν λιστα , 
    }
} else {
    echo "Error fetching role data: " . $conn->error;//λαθος , δεν υπαρχουν αποτελεσματα
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Χρήστης</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
</head>
<body> 

    <div class="reg-form">
        <h2>Καταχώρηση Χρήστη</h2>
        <form id="UserRegistration" name="userRegistration" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>"> <!--  echo $_SERVER['PHP_SELF']: Returns the filename of the currently executing script -->
            <label for="name">Όνομα:</label>
            <input type="text" id="Όνομα" name="name" placeholder="Όνομα" required>
            <p></p>
            <label for="lastname">Επώνυμο:</label>
            <input type="text" id="Επώνυμο" name="lastname" placeholder="Επώνυμο" required>
            <p></p>
            <label for="username">Όνομα Χρήστη:</label>
            <input type="text" id="ΌνομαΧρήστη" name="username" placeholder="Όνομα Χρήστη" required>
            <p></p>
            <label for="company_code">Κωδικός Εταιρείας:</label>
            <select name="company_code[]" id=list multiple onchange="toggleInputField(this)">
                <option value="">-- Επιλέξτε Κωδικό Εταιρείας/ες --</option>
                <?php echo $options_company; ?>
            </select>
            <label for="company_name">Όνομα Εταιρείας:</label>
            <input type="text" id="company_name" name="company_name" placeholder="Όνομα Εταιρείας" value="<?php echo isset($company_name) ? htmlspecialchars($company_name) : ''; ?> " readonly style="width: 300px;">
            <!-- echo isset($company_name) γτ: <br /><b>Warning</b>:  Undefined variable $company_name in <b>C:\xampp\htdocs\form.php</b> on line <b>141</b><br /> ,error μεσα στο πλαισιο Ονομα Εταιρεια -->
            <p></p>
            <p></p>
            <label for="department_name">Τμήμα:</label>
            <select name="department_name[]" id=list multiple onchange="toggleInputField(this)">
            <option value="">-- Επιλέξτε Τμήμα/τα --</option>
            <?php echo $options_dep; ?>
            <option value=other>Άλλο</option>
            <?php echo $other?>
            </select>
            <input type="text" id="new_department" name="new_department[]" placeholder="Τμήμα" style="display: none;">
            <p></p>
            <label for="email">Email:</label>
            <input type="email" id="Email" name="email" placeholder="Email" required>
            <p></p>
            <label for="password">Κωδικός:</label>
            <input type="password" id="Κωδικός" name="password" placeholder="Κωδικός" required>
            <p></p> 
            <label for="phone">Τηλέφωνο:</label>
            <input type="text" id="Τηλέφωνο" name="phone" placeholder="Τηλέφωνο" required>
            <p></p>
            <label for="role_name">Ρόλος/Θέση :</label>
            <select name="role_name[]" id=list onchange="toggleInputField(this)">
                <option value="">-- Επιλέξτε Θέση --</option>
                <?php echo $options_role_name; ?>
                <option value="other">Άλλο</option>
            </select>
            <input type="text" id="new_role_name" name="new_role_name[]" placeholder="Γράψτε μία θέση" style="display: none;">
            <p></p>
            <p></p>
            <label for="admin">Διαχειριστής:</label>
            <input type="checkbox" id="Διαχειριστής" name="admin"  value="checked" >
            <p></p>
            <textarea id="selected_items" name="selected_items" rows="4" cols="50" readonly></textarea>
            <p></p>
            <input type="submit" name="submit" value="Καταχώρηση">
        </form>
    </div>

<script> 
// Συνάρτηση που ενεργοποιεί/απενεργοποιεί πεδία εισαγωγής ανάλογα με την επιλογή στα dropdowns
function toggleInputField(selectElement) {// Ορίζει τη συνάρτηση toggleInputField με παράμετρο το στοιχείο επιλογής (selectElement)
    var inputField = document.getElementById("new_department"); // Αναζητά το πεδίο εισαγωγής με το id "new_department" και το αποθηκεύει στη μεταβλητή inputField
    var inputFieldRole = document.getElementById("new_role_name"); // Αναζητά το πεδίο εισαγωγής με το id "new_role" και το αποθηκεύει στη μεταβλητή inputFieldRole

  if (selectElement.name === "department_name[]") { // Ελέγχει αν το όνομα του επιλεγμένου στοιχείου είναι "department_name[]"
        if (selectElement.value === "other") { // Ελέγχει αν η τιμή του επιλεγμένου στοιχείου είναι "other"
            inputField.style.display = "block"; // Εμφανίζει το πεδίο εισαγωγής
            inputField.setAttribute("required",true); // Ορίζει το πεδίο ως υποχρεωτικό
        }
             else {
            inputField.style.display = "none"; // Κρύβει το πεδίο εισαγωγής
            inputField.removeAttribute("required"); // Αφαιρεί την υποχρεωτική ιδιότητα
        }
    }
    if (selectElement.name === "role_name[]") { // Ελέγχει αν το όνομα του επιλεγμένου στοιχείου είναι "role[]"
        if (selectElement.value === "other") { // Ελέγχει αν η τιμή του επιλεγμένου στοιχείου είναι "other"
            inputFieldRole.style.display = "block"; // Κάνει εμφανές το πεδίο εισαγωγής
            inputFieldRole.setAttribute("required",true); // Ορίζει το πεδίο ως υποχρεωτικό
        } 
            else {
            inputFieldRole.style.display = "none"; // Κρύβει το πεδίο εισαγωγής
            inputFieldRole.removeAttribute("required"); // Αφαιρεί την υποχρεωτική ιδιότητα
        }
    }
 
    // Ανανέωση του πεδίου κειμένου που περιέχει τα επιλεγμένα στοιχεία από τα dropdowns
    var selectedItemsField = document.getElementById("selected_items"); // Αναζητά το πεδίο κειμένου με το id "selected_items" και το αποθηκεύει στη μεταβλητή selectedItemsField
    var selectedItems = []; // Δημιουργεί έναν πίνακα για να αποθηκεύσει τα επιλεγμένα στοιχεία
    var selects = document.querySelectorAll('select'); // Επιλέγει όλα τα στοιχεία επιλογής στη σελίδα και τα αποθηκεύει στη μεταβλητή selects
    selects.forEach(function(select) { // Για κάθε στοιχείο επιλογής
        if (select.value !== "" && select.value !== "other") { // Ελέγχει αν η τιμή δεν είναι κενή και δεν είναι "other"
            var optionText = select.options[select.selectedIndex].text; // Αποθηκεύει το κείμενο της επιλεγμένης επιλογής
            selectedItems.push(optionText); // Προσθέτει το κείμενο στον πίνακα selectedItems
        } else if (select.value === "other" && select.previousElementSibling.value !== "") { // Ελέγχει αν η τιμή είναι "other" και το προηγούμενο πεδίο εισαγωγής έχει τιμή
            selectedItems.push(select.previousElementSibling.value); // Προσθέτει την τιμή του προηγούμενου πεδίου εισαγωγής στον πίνακα selectedItems
        }
    });
    selectedItemsField.value = selectedItems.join(","); // Ορίζει την τιμή του πεδίου κειμένου με το id "selected_items" ως ένα κομμένο κείμενο με χρήση κόμματος
}
// Συνάρτηση που ενημερώνει το πεδίο εισαγωγής με το όνομα της εταιρείας με βάση τον επιλεγμένο κωδικό εταιρεία
function updateCompanyName() {
    var companyCodeSelect = document.getElementsByName('company_code[]')[0];
    var companyNameInput = document.getElementById('company_name');
    var selectedIndex = companyCodeSelect.selectedIndex;
    var companyCode = companyCodeSelect.options[selectedIndex].value;

     // Ajax κλήση για να ανακτήσει το όνομα της εταιρείας
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                companyNameInput.value = xhr.responseText;
            }
        }
    };
    xhr.open("GET", "get_company_name.php?company_code=" + companyCode, true);
    xhr.send();
}
     
// Επισύναψη της συνάρτησης updateCompanyName στο γεγονός αλλαγής της επιλογής κωδικού εταιρείας
var companyCodeSelect = document.getElementsByName('company_code[]')[0];
companyCodeSelect.addEventListener('change', updateCompanyName);

function updateSelectedItems() {

  // Προσθήκη τιμών από το πεδίο name
  var nameValue = document.getElementById("Όνομα").value.trim();
    if (nameValue !== "") {
        selectedItems.push(nameValue);
    }
    // Προσθήκη τιμών από το πεδίο lastname
    var lastnameValue = document.getElementById("Επώνυμο").value.trim();
    if (lastnameValue !== "") {
        selectedItems.push(lastnameValue);
    }
    // Προσθήκη τιμών από το πεδίο username
    var usernameValue = document.getElementById("Όνομα Χρήστη").value.trim();
    if (usernameValue !== "") {
        selectedItems.push(usernameValue);
    }
    // Προσθήκη τιμών από το πεδίο email
    var emailValue = document.getElementById("Email").value.trim();
    if (emailValue !== "") {
        selectedItems.push(emailValue);
    }
        // Προσθήκη τιμών από το πεδίο password
        var passwordValue = document.getElementById("Κωδικός").value.trim();
    if (passwordValue !== "") {
        selectedItems.push(passwordValue);
    }
        // Προσθήκη τιμών από το πεδίο phone
        var phoneValue = document.getElementById("Τηλέφωνο").value.trim();
    if (phoneValue !== "") {
        selectedItems.push(phoneValue);
    }

    document.getElementById("Όνομα").addEventListener("input", updateSelectedItems);
    document.getElementById("Επώνυμο").addEventListener("input", updateSelectedItems);
    document.getElementById("Όνομα Χρήστη").addEventListener("input", updateSelectedItems);
    document.getElementById("Όνομα Εταιρείας").addEventListener("input", updateSelectedItems);
    document.getElementById("Email").addEventListener("input", updateSelectedItems);
    document.getElementById("Κωδικός").addEventListener("input", updateSelectedItems);
    document.getElementById("Τηλέφωνο").addEventListener("input", updateSelectedItems);
}

document.addEventListener("DOMContentLoaded", function() {
    updateSelectedItems();
});

</script>

</body>
</html>

