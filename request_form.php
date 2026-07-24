<?php
session_start();
<<<<<<< HEAD
include 'connection.php';
include 'user_requests_menu.html';

// Έλεγχος αν ο χρήστης έχει συνδεθεί
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'], $_POST['username'], $_POST['email'], $_POST['request'], $_POST['title'])) {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $request = $_POST['request'];
        $title = $_POST['title'];

        // Validate and sanitize inputs
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format";
        } else {
            // Insert the request into the database
            $stmt = $conn->prepare("INSERT INTO requests (user_id, name, username, email, request, title) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssss", $user_id, $name, $username, $email, $request, $title);

            if ($stmt->execute()) {
                echo "<script>alert('Το αίτημά σας καταχωρήθηκε επιτυχώς!'); window.location.href='my_requests.php';</script>";
                exit();
            } else {
                echo "Συνέβη κάποιο λάθος.";
            }
            $stmt->close();
        }
=======
include 'user_requests_menu.html';
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

// Check if user_id is set
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    // If user_id is not set, handle the situation accordingly
    die("User ID is not set.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'], $_POST['email'], $_POST['request'], $_POST['title'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $request = $_POST['request'];
        $title = $_POST['title'];
        
        // Check if there is already a request with the same title
        $stmt = $conn->prepare("SELECT * FROM requests WHERE title = ?");
        $stmt->bind_param("s", $title);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Υπάρχει ήδη ένα αίτημα με αυτό το θέμα. Παρακαλώ εισάγετε ένα διαφορετικό τίτλο.";
        } else {
            // Insert the request into the database
            $stmt = $conn->prepare("INSERT INTO requests (user_id, name, email, request, title) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $user_id, $name, $email, $request, $title);

            if ($stmt->execute()) {
                echo "\n\n Το αίτημα σας καταχωρήθηκε επιτυχώς!";
                header("Location: my_requests.php");
                exit; // Exit to avoid executing code after the redirect
            } else {
                echo "Συνέβη κάποιο λάθος.";
            }
            $stmt->close(); // Close the statement
        }
        $stmt->close(); // Close the check statement
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
    } else {
        echo "Συνέβη κάποιο λάθος.";
    }
}
<<<<<<< HEAD

=======
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Καταχώρηση Αιτήματος</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .request-form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .request-form h1 {
            margin-bottom: 20px;
        }
        .request-form label {
            display: block;
            margin-bottom: 5px;
        }
        .request-form input[type="text"],
        .request-form input[type="email"],
        .request-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .request-form input[type="submit"] {
            width: auto;
            padding: 10px 20px;
            background-color: #00234B;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .request-form input[type="submit"]:hover {
            background-color: #001a33;
        }
    </style>
    <script>
        function countWords(text) {
            return text.trim().split(/\s+/).length;
        }

        function checkWordLimit() {
            const titleField = document.getElementById('title');
            const wordLimit = 50;
            const words = countWords(titleField.value);
            const warningMessage = document.getElementById('word-warning');
            
            if (words > wordLimit) {
                warningMessage.textContent = "Έχετε υπερβεί το όριο των 50 λέξεων.";
                return false;
            } else {
                warningMessage.textContent = "";
                return true;
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById('request-form');
            form.onsubmit = function(event) {
                if (!checkWordLimit()) {
                    event.preventDefault();
                }
            };
        });
    </script>
=======
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
</head>
<body>

<div class="request-form">
    <h1><strong>Καταχώρηση Αιτήματος</strong></h1>
    <form id="request-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<<<<<<< HEAD
        <p>
            <label for="title">Θέμα:</label>
            <input type="text" id="title" name="title" required oninput="checkWordLimit()">
            <span id="word-warning" style="color: red;"></span>
        </p>
        <p>
            <label for="name">Ονοματεπώνυμο:</label>
            <input type="text" id="name" name="name" required>
        </p>
        <p>
            <label for="username">Όνομα Χρήστη:</label>
            <input type="text" id="username" name="username" required>
        </p>
        <p>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </p>
        <p>
            <label for="request">Αίτημα:</label>
            <textarea id="request" name="request" rows="5" required></textarea>
        </p>
        <p>
            <input type="submit" name="submit" value="Καταχώρηση">
        </p>
=======
        <input type="submit" name="submit" value="Καταχώρηση">
        <label for="title">Θέμα:</label>
        <input type="text" id="title" name="title" required style="width: 300px;">
        <p></p>
        <label for="name">Ονοματεπώνυμο:</label>
        <input type="text" id="name" name="name" required style="width: 300px;">
        <p></p>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required style="width: 300px;">
        <p></p>
        <label for="request">Αίτημα:</label>
        <textarea id="request" name="request" rows="26" cols="175" required></textarea>
        <p></p>
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
    </form> 
</div>

</body>
</html>
