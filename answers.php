<?php
<<<<<<< HEAD
session_start();
include 'answers css.html';
// Έλεγχος αν ο χρήστης έχει συνδεθεί
if (!isset($_SESSION['user_id'])) {
    // Αν δεν έχει συνδεθεί, ανακατεύθυνση στη σελίδα σύνδεσης
    header("Location: login.php");
    exit();
}

// Αν έχει συνδεθεί, μπορείτε να χρησιμοποιήσετε το user_id από τη συνεδρία
$user_id = $_SESSION['user_id'];
$servername = "localhost";
$username = "admin";
$password = "B@kal@r05";
$dbname = "register";
=======
include 'answers css.html';

$servername = "localhost";
$username = "admin";
$password = "B@kal@r05";
$dbname = "register";11111
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
<<<<<<< HEAD
    die("Connection failed: " . $conn->connect_error);
=======
  die("Connection failed: " . $conn->connect_error);
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
}

?>

<<<<<<< HEAD
=======

>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
<!DOCTYPE html>
<html>
<head>
    <title>Καταχώρηση Απάντησης</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="answer_form">
<<<<<<< HEAD
    <h1>Λεπτομέρειες Απάντησης</h1>
    
        <?php
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Έλεγχος αν παρέχονται όλες οι απαιτούμενες παράμετροι
            if(isset($_POST['id'], $_POST['answer'])) {
                $request_id = $_POST['id'];
                $admin_answer = $_POST['answer']; // Λήψη της απάντησης από τη φόρμα
        
        
                // Καταχώρηση της απάντησης στη βάση δεδομένων
                $stmt = $conn->prepare("INSERT INTO answers (request_id, user_id, admin_answer) VALUES (?, ?, ?)");
                $stmt->bind_param("iis", $request_id, $user_id, $admin_answer);
        
                if ($stmt->execute()) {
                    echo "Η απάντηση καταχωρήθηκε επιτυχώς.";
                  //  echo "<script>window.location.href = 'requests.php';</script>";
                    // Μεταφορά πίσω στη λίστα των αιτημάτων
                    exit();
                } else {
                    echo "Συνέβη κάποιο σφάλμα κατά την καταχώρηση της απάντησης.";
                }
                $stmt->close();
            } else {
                echo "Δε βρέθηκαν απαραίτητα πεδία.";
            }
         }
         
=======
    <h1><strong>Λεπτομέρειες Απάντησης</strong></h1>
    
        <?php
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Query to select details of the request
<<<<<<< HEAD
            $stmt = $conn->prepare("SELECT requests.id AS request_id, requests.title, answers.user_answer, answers.admin_answer
                                    FROM requests  
                                    LEFT JOIN answers ON requests.id = answers.request_id 
                                    WHERE requests.id = ? AND (answers.user_answer != '' OR answers.admin_answer != '')");
=======
            $stmt = $conn->prepare("SELECT   title, request, answer  FROM requests WHERE id = ?");
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($result->num_rows > 0) {
                echo "<p><strong>Θέμα:</strong> " . $row['title'] . "</p>";
<<<<<<< HEAD
                if ($row['user_answer'] != '') {
                    echo "<p><strong>Απάντηση χρήστη:</strong> " . $row['user_answer'] . "</p>";
                }
                if ($row['admin_answer'] != '') {
                    echo "<p><strong>Απάντηση διαχειριστή:</strong> " . $row['admin_answer'] . "</p>";
                }
   // Φόρμα για την υποβολή απάντησης
   echo "<form method='post'>";
   echo "<input type='hidden' name='id' value='" . $id . "'>";
   echo "<p></p>";
   echo "<input type='submit' value='Καταχώρηση'>";
   echo "<p></p>";
   echo "<textarea name='answer' rows='23' cols='178'></textarea><br>";
   echo "</form>";
} else {
   echo "Δεν βρέθηκε αίτημα με το συγκεκριμένο ID.";
}
            $stmt->close();
        } else {
            echo "Δεν βρέθηκε ID αιτήματος.";
        }
        // Close the connection
        $conn->close();
        ?>
=======
                echo "<p><strong>Αίτημα:</strong> " . $row['request'] . "</p>";
                echo "<p><strong>Απάντηση:</strong> " . $row['answer'] . "</p>";

            } else {
                echo "Δεν βρέθηκε αίτημα με το συγκεκριμένο ID.";
            }

            $stmt->close();
        } else {
            echo "Δε βρέθηκε ID αιτήματος.";
        }
       // Close the connection
$conn->close();
 ?>
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
    </div>
</body>
</html>
