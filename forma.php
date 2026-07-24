<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
     <!--<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/form.css">-->
</head>
<body> 
    <!-- <div class="userRegistration">-->
         <div class="userRegistration-form">
        <h2>Καταχώρηση Χρήστη</h2>
        <div class="rounded-md shadow-sm -space-y-px">
        </div>
        <form id="UserRegistration" name="userRegistration" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <label for="name">Όνομα:</label>
            <input type="text" id="Όνομα" name="name" placeholder="Όνομα" required>
            <p></p>
            <label for="lastname">Επώνυμο:</label>
            <input type="text" id="Επώνυμο" name="lastname" placeholder="Επώνυμο" required>
            <p></p>
            <label for="username">Όνομα Χρήστη:</label>
            <input type="text" id="Όνομα Χρήστη" name="username" placeholder="Όνομα Χρήστη" required>
            <p></p>
            <label for="company_id">Εταιρεία:</label>
            <select id="Εταιρεία" name="company_id">
                <option value="">--Επιλέξτε Εταιρεία/ες--</option>
                <option value="001">001:Κ.Δ.ΜΠΑΚΑΛΑΡΟΣ ΑΕ</option>
                <option value="002">002:ΘΑΝΑΣΟΥΛΑΣ Α.Ε.</option>
                <option value="005">005:ΜΠΑΚΑΡ Α.Ε.</option>
                <option value="006_1">006-1:ΔΗΠΕΙΡΟΣ Α.Ε.: Κεντρική Ιωαννίνων</option>
                <option value="003_1">003-1:ΔΗΠΕΙΡΟΣ Α.Ε.: Κεντρική Άρτας</option>
                <option value="004_1">004-1:ΔΗΠΕΙΡΟΣ Α.Ε.: Κεντρική Θεσπρωτίας</option>
                <option value="007">007:ΚΑΒΑ ΚΟΥΛΙΕΡΗΣ Α.Ε.</option>
                <option value="008">008:FDRINK AE</option>
            </select>
            <p></p>
            <label for="department_id">Τμήμα:</label>
            <input type="text" id="Τμήμα" name="department_id" placeholder="Τμήμα" required>
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
            <label for="role">Ρόλος/Θέση:</label>
            <select id="role" name="role">
                     <option value="">--Επιλέξτε Θέση--</option>
                     <option value="sales">Εξυπηρέτηση Πελατών</option>
                     <option value="manager">Διεύθυνση</option>
                     <option value="marketing">Λογιστήριο</option>
                     <option value="other">Άλλο</option>
            </select>
            <input type="text" id="new_role" name="new_role" placeholder="Γράψτε μία θέση">
            <p></p>
            <button type="submit">Καταχώρηση</button>
        </form>
    </div>


    <?php
     $servername = "localhost";
     $username = "admin";
     $password = "B@kal@r05";
     $dbname = "v_new";

     $conn = new mysqli($servername, $username, $password, $dbname);
     
     // Έλεγχος σύνδεσης
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }

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

        $stmt = $conn->prepare("SELECT * FROM users WHERE name=? OR lastname=? OR username=? OR company_id=? OR department_id=? OR email=? OR phone=? OR role=?");
        $stmt->bind_param("ssssssss", $name, $lastname, $username, $company_id, $department_id, $email, $phone, $role);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            $stmt = $conn->prepare("INSERT INTO users (name, lastname, username, company_id, department_id, email, password, phone, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssss", $name, $lastname, $username, $company_id, $department_id, $email, $password, $phone, $role);

            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $stmt->error;
            }  

            $stmt->close();
        } else {
            echo "User already exists";
        }
    }
    
    $conn->close();
?>


</body>
</html>
