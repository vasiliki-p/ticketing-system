<?php 
// 1. Το session_start() και η PHP λογική μπαίνουν στην απόλυτη κορυφή!
session_start();
include 'connection.php';

$error_message = "";

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
                
                if ($user['admin'] == 1) {
                    header("Location: admin.php");
                } else {
                    header("Location: user.php");
                }
                exit(); // ΣΗΜΑΝΤΙΚΟ: Σταματάμε την εκτέλεση μετά από ανακατεύθυνση (header)
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
        <title>Login / Welcome Page</title>
        
        <!-- Τα CSS links μεταφέρθηκαν σωστά μέσα στο <head> -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./register.css">
        
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                margin: 0;
                padding: 0;
                display: flex;
                flex-direction: column; /* Άλλαξε σε column για να μπει το link από κάτω */
                justify-content: center;
                align-items: center;
                height: 100vh;
                /* Αν εξακολουθεί να βγάζει 404, έλεγξε το path και τα κεφαλαία/μικρά γράμματα στο GitHub */
                background-image: url('Logos/website_logo_3d_backgrounds_dark-orange.jpg');
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

            /* Πρόσθεσα στυλ για να φαίνεται όμορφα το μήνυμα λάθους */
            .error-message {
                color: #d93025;
                font-size: 0.9em;
                margin-top: 15px;
                text-align: center;
                font-weight: bold;
            }
            
            .login_link {
                margin-top: 20px;
                background-color: rgba(255, 255, 255, 0.8);
                padding: 10px;
                border-radius: 5px;
            }
        </style> 
    </head>
    <body>
        <div class="login-container">
            <h2>Σύνδεση</h2>
            <form id="Login" name="Login" method="POST" action=""> 
                <!-- Προστέθηκαν τα autocomplete attributes -->
                <input type="text" id="username" name="username" placeholder="Όνομα Χρήστη" autocomplete="username" required>
                <input type="password" id="password" name="password" placeholder="Κωδικός" autocomplete="current-password" required>
                <button type="submit">Είσοδος</button>
            </form>
            
            <!-- Εμφάνιση μηνύματος λάθους αν υπάρχει -->
            <?php if (!empty($error_message)): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="login_link">
            <a href="./login.php"> 
                <p class="m-0 font-bold text-blue-800">Σύνδεση</p>
            </a> 
        </div>
    </body>
</html>
