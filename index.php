<?php 
session_start();
include 'connection.php';

$error_message = ""; // Μεταβλητή για να αποθηκεύουμε τα μηνύματα λάθους

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username'], $_POST['password'])){
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        // Ερώτημα για έλεγχο εάν ο χρήστης υπάρχει ήδη στη βάση
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Υπάρχει εγγραφή με αυτό το όνομα χρήστη
            $user = $result->fetch_assoc();
            
            if (password_verify($password, $user['password'])) {
                // Εκχώρηση του user_id στη συνεδρία
                $_SESSION['user_id'] = $user['user_id'];
                
                // Επιτυχής σύνδεση - Ανακατεύθυνση
                if ($user['admin'] == 1) {
                    header("Location: admin.php");
                } else {
                    header("Location: user.php");
                }
                exit(); // Σταματάμε την εκτέλεση αμέσως μετά την ανακατεύθυνση
            } else {
                $error_message = "Λανθασμένο όνομα χρήστη ή λανθασμένος κωδικός πρόσβασης.";
            }
        } else {
            $error_message = "Ο χρήστης δεν υπάρχει.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="el">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=0.8">
        <title>Login</title>
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background-image: url('./website_logo_3d_backgrounds_dark-orange.jpg');
                background-size: cover;
                background-position: center;
            }

            .login-container {
                width: 300px;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                background-color: #ccc;
            }

            h2 {
                text-align: center;
            }

            form {
                margin-top: 20px;
            }

            input[type="text"],
            input[type="password"],
            button {
                width: 100%;
                padding: 10px;
                margin-top: 10px;
                border: 1px solid #ccc;
                border-radius: 3px;
                box-sizing: border-box;
            }

            button {
                background-color: #00234B;
                color: white;
                cursor: pointer;
            }

            .error-message {
                color: #d93025;
                margin-top: 15px;
                text-align: center;
                font-weight: bold;
                font-size: 0.9em;
            }
        </style> 
    </head>
    <body>
        <div class="login-container">
            <h2>Σύνδεση</h2>
            <form id="Login" name="Login" method="POST"> 
                <!-- Άλλαξα το id σε λατινικούς χαρακτήρες για σωστή πρακτική -->
                <input type="text" id="username" name="username" placeholder="Όνομα Χρήστη" autocomplete="username" required>
                <input type="password" id="password" name="password" placeholder="Κωδικός" autocomplete="current-password" required>
                <button type="submit">Είσοδος</button>
            </form>
<<<<<<< HEAD
        

        <?php 
        
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['username'],$_POST['password'])){
                $username = $_POST['username'];
                $password = $_POST['password'];
                // Ερώτημα για έλεγχο εάν ο χρήστης υπάρχει ήδη στη βάση
                $stmt = $conn->prepare("SELECT * FROM users WHERE username=? ");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();
                
                // Εισαγωγή στοιχείων χρήστη αν δεν υπάρχει ήδη
                if ($result->num_rows > 0) {
                    // Υπάρχει εγγραφή με αυτό το όνομα χρήστη
                    $user = $result->fetch_assoc();
                    $user_id = $user['user_id'];
                    
                    // Εκχώρηση του user_id στη συνεδρία
                    $_SESSION['user_id'] = $user_id;

                    if (password_verify($password, $user['password'])) {
                        if ($user['admin'] == 1) {
                            header("Location: admin.php");
                        } else {
                            header("Location: user.php");
                        }
                    } else {
                        // Ο κωδικός δεν είναι σωστός
                        echo "\n\n Λανθασμένο όνομα χρήστη ή λανθασμένος κωδικός πρόσβασης";
                    }
                } else {
                    echo "\n\n Ο χρήστης δεν υπάρχει " ;
                }
            }
            exit();
        }

        ?>
    
    
    </div>
=======
            
            <!-- Εμφάνιση μηνύματος λάθους (αν υπάρχει) -->
            <?php if (!empty($error_message)): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>
        </div>
>>>>>>> 04b93a5829e28bf9ef3540309fb77f806fa2210b
    </body>
</html>
