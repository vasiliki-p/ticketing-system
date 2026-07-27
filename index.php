<?php 
session_start();
include 'connection.php';

// Χρησιμοποιούμε non-breaking space (&nbsp;) για να έχει πάντα σταθερό ύψος το κουτί του λάθους
$error_message = "&nbsp;"; 

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
                $error_message = "Λανθασμένο όνομα χρήστη ή κωδικός.";
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
        <title>Login - Ticketing System</title>
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
                background-color: #ccc; /* Το αρχικό σου γκρι */
            }

            h2 {
                text-align: center;
                margin-top: 0;
            }

            form {
                margin-top: 10px;
            }

            input[type="text"],
            input[type="password"],
            .submit-btn {
                width: 100%;
                padding: 10px;
                margin-top: 10px;
                border: 1px solid #aaa;
                border-radius: 3px;
                box-sizing: border-box;
            }

            .submit-btn {
                background-color: #00234B; /* Το αρχικό σου μπλε */
                color: white;
                cursor: pointer;
                font-weight: bold;
                transition: opacity 0.2s;
            }
            
            .submit-btn:hover {
                opacity: 0.9;
            }

            .error-message {
                color: #d93025;
                margin-top: 5px;
                text-align: center;
                font-weight: bold;
                font-size: 0.9em;
                /* Το βάζω με σταθερό ύψος για να μην κουνιέται η φόρμα */
                height: 20px; 
                line-height: 20px;
            }

            /* --- Στυλ για το Demo Box --- */
            .demo-box {
                margin-top: 20px;
                padding: 15px;
                background-color: rgba(255, 255, 255, 0.4); /* Ημιδιαφανές λευκό για να ταιριάζει με το γκρι */
                border: 1px dashed #666;
                border-radius: 5px;
                font-size: 13px;
            }
            
            .demo-box h4 {
                margin: 0 0 5px 0;
                text-align: center;
                color: #222;
                font-size: 14px;
            }

            .demo-btn {
                display: block;
                width: 100%;
                margin-bottom: 8px;
                padding: 8px;
                background-color: #fff;
                color: #00234B;
                border: 1px solid #888;
                border-radius: 3px;
                cursor: pointer;
                text-align: left;
                font-size: 12px;
                transition: transform 0.2s, background-color 0.2s;
            }

            .demo-btn:hover {
                background-color: #f0f0f0;
                transform: scale(1.02);
            }
        </style> 
    </head>
    <body>
        <div class="login-container">
            <h2>Σύνδεση</h2>
            
            <!-- Εδώ εμφανίζεται το λάθος (σταθερό ύψος) -->
            <div class="error-message">
                <?php echo $error_message; ?>
            </div>

            <form id="Login" name="Login" method="POST"> 
                <input type="text" id="username" name="username" placeholder="Όνομα Χρήστη" autocomplete="username" required>
                <input type="password" id="password" name="password" placeholder="Κωδικός" autocomplete="current-password" required>
                <button type="submit" class="submit-btn">Είσοδος</button>
            </form>
        
            <!-- Το Demo Box -->
            <div class="demo-box">
                <h4>🛠️ Demo Access</h4>
                <p style="text-align: center; margin-top: 0; margin-bottom: 10px; color: #444; font-size: 11px;">Click a role to auto-fill:</p>
                
                <button type="button" class="demo-btn" onclick="fillCredentials('user_demo', '1234')">
                    👤 <b>Employee:</b> user_demo
                </button>
                <button type="button" class="demo-btn" style="margin-bottom: 0;" onclick="fillCredentials('admin_demo', '1234')">
                    ⚙️ <b>Admin:</b> admin_demo
                </button>
            </div>
        </div>

        <!-- Το Script που κάνει το auto-fill -->
        <script>
            function fillCredentials(user, pass) {
                document.getElementById('username').value = user;
                document.getElementById('password').value = pass;
            }
        </script>
    </body>
</html>
