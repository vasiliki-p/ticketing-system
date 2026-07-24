 <?php
 //session_start();
 
    // Σύνδεση στη βάση δεδομένων 
    $servername = "localhost";
    $username = "admin";
    $password = "B@kal@r05";
    $dbname = "v_new";

    // Δημιουργία σύνδεσης
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Έλεγχος σύνδεσης
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Ελέγχουμε αν η φόρμα έχει υποβληθεί
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Λήψη δεδομένων από τη φόρμα
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $company_id = $_POST['company_id'];
        $department_id = $_POST['department_id'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
        $phone = $_POST['phone'];
        $role = $_POST['role'];

    // Έλεγχος για την ύπαρξη ήδη των δεδομένων στη βάση δεδομένων
        $sql = "SELECT * FROM users WHERE name=? OR lastname=? OR username=? OR company_id=? OR department_id=? OR email=? OR phone=? OR role=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssss", $name, $lastname, $username, $company_id, $department_id, $email, $phone, $role);
        $stmt->execute();
        $result = $stmt->get_result();
        // Εάν δεν υπάρχουν εγγραφές με τα ίδια δεδομένα, εισάγετε τα νέα δεδομένα
    if ($result->num_rows == 0) {
        // Εισαγωγή δεδομένων στη βάση δεδομένων με προετοιμασμένη δήλωση
        $stmt = $conn->prepare("INSERT INTO users (name, lastname, username, company_id, department_id, email, password, phone, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $name, $lastname, $username, $company_id, $department_id, $email, $password, $phone, $role);

        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }  

        $stmt->close();
    }
    }
    // Κλείσιμο σύνδεσης με τη βάση δεδομένων
    $conn->close();
    ?>