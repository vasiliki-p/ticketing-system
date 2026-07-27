<?php 
session_start();
include 'connection.php'; // Πρόσθεσα το connection file γιατί χρησιμοποιείς το $conn

$error_msg = "&nbsp;"; // Σταθερό κενό για να μην κουνιέται η φόρμα

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username'], $_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Ερώτημα για έλεγχο εάν ο χρήστης υπάρχει ήδη στη βάση
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $user_id = $user['user_id'];
            
            if (password_verify($password, $user['password'])) {
                // Εκχώρηση του user_id στη συνεδρία μόνο αν το password είναι σωστό
                $_SESSION['user_id'] = $user_id;

                if ($user['admin'] == 1) {
                    header("Location: admin.php");
                } else {
                    header("Location: user.php");
                }
                exit();
            } else {
                $error_msg = "Λανθασμένος κωδικός πρόσβασης";
            }
        } else {
            $error_msg = "Ο χρήστης δεν υπάρχει";
        }
    }
}
?>

<!DOCTYPE html>
<html>
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
                background-color: #f0f2f5; /* Λίγο πιο μοντέρνο background */
            }

            .login-container {
                width: 320px; /* Ελαφρώς μεγαλύτερο για να χωράνε ωραία τα κουμπιά */
                padding: 20px 25px;
                border: 1px solid #ccc;
                border-radius: 8px;
                background-color: #ffffff;
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            }

            h2 {
                text-align: center;
                margin-top: 0;
                margin-bottom: 15px;
                color: #333;
            }

            form {
                margin-top: 10px;
            }

            input[type="text"],
            input[type="password"] {
                width: 100%;
                padding: 12px;
                margin-top: 8px;
                margin-bottom: 8px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            .submit-btn {
                width: 100%;
                padding: 12px;
                margin-top: 10px;
                border: none;
                border-radius: 4px;
                box-sizing: border-box;
                background-color: #4CAF50;
                color: white;
                font-weight: bold;
                font-size: 15px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            .submit-btn:hover {
                background-color: #45a049;
            }

            /* --- Demo Box Styles --- */
            .demo-box {
                margin-top: 20px;
                padding: 15px;
                background-color: #f8f9fa;
                border: 1px dashed #aaa;
                border-radius: 6px;
            }

            .demo-box h4 {
                margin: 0 0 10px 0;
                text-align: center;
                font-size: 14px;
                color: #444;
            }

            .demo-btn {
                display: block;
                width: 100%;
                margin-bottom: 8px;
                padding: 8px 10px;
                background-color: white; 
                border: 1px solid #ddd;
                border-radius: 4px;
                cursor: pointer;
                text-align: left;
                font-size: 13px;
                color: #333;
                transition: all 0.2s;
            }

            .demo-btn:hover {
                background-color: #e9ecef;
                border-color: #ccc;
                transform: scale(1.02);
            }
        </style> 
    </head>
    <body>
        <div class="login-container">
            <h2>Σύνδεση</h2>
            
            <!-- Σταθερό πλαίσιο για τα μηνύματα λάθους -->
            <div style="height: 20px; line-height: 20px; color: #d9534f; text-align: center; font-size: 13px; font-weight: bold;">
                <?php echo $error_msg; ?>
            </div>

            <form id="Login" name="Login" method="POST"> 
                <!-- Άλλαξα τα id σε username και password για να δουλέψει η JS -->
                <input type="text" id="username" name="username" placeholder="Όνομα Χρήστη" required>
                <input type="password" id="password" name="password" placeholder="Κωδικός" required>
                <button type="submit" class="submit-btn">Είσοδος</button>
            </form>

            <!-- 💡 DEMO ACCOUNTS BOX -->
            <div class="demo-box">
                <h4>🛠️ Demo Access (Levels)</h4>
                <p style="text-align: center; margin: 0 0 10px 0; color: #666; font-size: 11px;">Select a role to auto-fill:</p>
                
                <button type="button" class="demo-btn" onclick="fillCredentials('user_demo', '1234')">
                    👤 <b>Employee:</b> user_demo
                </button>
                <button type="button" class="demo-btn" style="margin-bottom: 0;" onclick="fillCredentials('admin_demo', '1234')">
                    ⚙️ <b>Admin:</b> admin_demo
                </button>
            </div>
        </div>

        <script>
            function fillCredentials(user, pass) {
                document.getElementById('username').value = user;
                document.getElementById('password').value = pass;
            }
        </script>
    </body>
</html>
