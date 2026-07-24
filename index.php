<?php include 'connection.php';
        session_start();
?>

<!DOCTYPE html>
<html>
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
            background-image: url('/website_logo_3d_backgrounds_dark-orange.jpg');
            background-size: cover;
            background-position: center;}

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
        </style> 
    </head>
    <body>
        <div class="login-container">
            <h2>Σύνδεση</h2>
            <form id="Login" name="Login" method="POST"> 
                <input type="text" id="Όνομα Χρήστη" name="username" placeholder="Όνομα Χρήστη" required>
                <input type="password" id="Κωδικός" name="password" placeholder="Κωδικός" required>
                <button type="submit">Είσοδος</button>
            </form>
        


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
    </body>
</html>
