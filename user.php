<?php 
<<<<<<< HEAD
include 'user_id login.php';
include 'connection.php';
=======
session_start();



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
//echo "Connected successfully";

// Έλεγχος αν ο χρήστης έχει συνδεθεί
if (!isset($_SESSION['user_id'])) {
    // Αν δεν έχει συνδεθεί, ανακατεύθυνση στη σελίδα σύνδεσης
    header("Location: login.php");
    exit();
}

// Αν έχει συνδεθεί, μπορείτε να χρησιμοποιήσετε το user_id από τη συνεδρία
$user_id = $_SESSION['user_id'];

// Τώρα μπορείτε να χρησιμοποιήσετε το $user_id για να ανακτήσετε τα αιτήματά του από τη βάση δεδομένων
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=0.8">
<<<<<<< HEAD
        <title>Home Page</title>
=======
        <title>Welcome Page</title>
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body>
    <?php include 'user_menu.html';?>

     <div class="main">
    <h1>Καλώς ήρθατε!</h1>
    </div>
    </body>
</html>








