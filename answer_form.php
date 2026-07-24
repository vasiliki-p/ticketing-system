<<<<<<< HEAD

<?php
include 'user_id login.php';
include 'connection.php';
include 'answers_form css.html';
=======
<?php


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

>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b

?>

<!DOCTYPE html>
<html>
<head>
<title>Καταχώρηση Απάντησης</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD

</head>
<body>

    <div class="answer_form">
        <!--<h1>Λεπτομέρειες Απάντησης</h1>-->


 <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Έλεγχος αν παρέχονται όλες οι απαιτούμενες παράμετροι
    if(isset($_POST['id'], $_POST['answer'])) {
        $request_id = $_POST['id'];
        $user_answer = $_POST['answer']; // Λήψη της απάντησης από τη φόρμα


        // Καταχώρηση της απάντησης στη βάση δεδομένων
        $stmt = $conn->prepare("INSERT INTO answers (request_id, user_id, user_answer) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $request_id, $user_id, $user_answer);

        if ($stmt->execute()) {
            echo "Η απάντηση καταχωρήθηκε επιτυχώς.";
          //  echo "<script>window.location.href = 'requests.php';</script>";
            // Μεταφορά πίσω στη λίστα των αιτημάτων
            exit();
=======
    <!-- Include your CSS file -->
       <link rel="stylesheet" type="text/css" href="answers_form css.html">

</head>
<body>
 <?php include 'answers_form css.html';?>
 <div class="answer_form">
    <h1><strong>Λεπτομέρειες Αιτήματος</strong></h1>



 <?php

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required parameters are provided
    if(isset($_POST['id'], $_POST['answer'])) {
        $id = $_POST['id'];
        $answer = $_POST['answer'];

        // Insert the response into the database
        $stmt = $conn->prepare("UPDATE requests SET answer = ?, updated_at = NOW() WHERE id = ?");
        $stmt->bind_param("si", $answer, $id);

        if ($stmt->execute()) {
            echo "Η απάντηση καταχωρήθηκε επιτυχώς.";
          //  header("Location: requests.php");

>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
        } else {
            echo "Συνέβη κάποιο σφάλμα κατά την καταχώρηση της απάντησης.";
        }
        $stmt->close();
    } else {
        echo "Δε βρέθηκαν απαραίτητα πεδία.";
    }
 }
<<<<<<< HEAD
 
=======

>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Query to select details of the request
<<<<<<< HEAD
            $stmt = $conn->prepare("SELECT requests.id AS request_id, requests.title, requests.request, requests.created_at,requests.name, concat( answers.user_answer,' ', answers.admin_answer)  as answers, users.username
            FROM requests  
            LEFT JOIN answers ON requests.id = answers.request_id 
            LEFT JOIN users ON users.user_id = answers.user_id
            WHERE requests.id = ? 
            ");
=======
            $stmt = $conn->prepare("SELECT name, email, request FROM requests WHERE id = ?");
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($result->num_rows > 0) {
<<<<<<< HEAD
                echo "<div class='container'>";
                echo "<div class='header-box'>";  
                echo "<span style='margin-right: 20px;'><strong>Θέμα:</strong> " . $row['title'] . "</span>";
                echo "<span style='margin-right: 20px;'><strong>Όνομα:</strong> " . $row['name'] ."</span>";
                echo "<span style='margin-right: 20px;'><strong>Ημερομηνία Δημιουργίας:</strong> " . $row['created_at'] . "</span>";
                echo "<br>";
                echo "<br>";
              
                echo "<p>" . $row['request']." </p>";
      
                echo "</div>";             
                echo "<div class='answers-box'>";
              
                foreach ($result as $row) {
                    echo "<p><strong>" . $row['username'] . ": </strong> ". $row['answers'] . "</p>";
                }
                echo "</div>";


                // Φόρμα για την υποβολή απάντησης
                echo "<form method='post'>";
                echo "<p><strong>Απάντηση:</strong>";
                echo "<input type='submit' value='Καταχώρηση'>";
                echo "<br>";  
                echo "<div>";
                echo "<input type='hidden' name='id' value='" . $id . "'>";
                echo "<textarea name='answer' rows='18' cols='190'></textarea></p>";
                echo "</div>";

                echo "</form>";
            } else {
                echo "Δεν βρέθηκε αίτημα με το συγκεκριμένο ID.";
            }
        
            $stmt->close();
        } else {
            echo "Δεν βρέθηκαν απαντήσεις.";
        }
        
       // Close the connection

=======
                echo "<p><strong>Ονοματεπώνυμο:</strong> " . $row['name'] . "</p>";
                echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
                echo "<p><strong>Αίτημα:</strong> " . $row['request'] . "</p>";

                // Form to submit response
                echo "<form  method='post'>";
                echo "<input type='hidden' name='id' value='" . $id . "'>";
                echo "<p></p>";
                echo "<input type='submit' value='Καταχώρηση'>";
                echo "<p></p>";
                echo "<h2><strong>Απάντηση</strong></h2>";
                echo "<textarea name='answer' rows='23' cols='178'></textarea><br>";
                echo "</form>";
                echo"</div>";
            } else {
                echo "Δεν βρέθηκε αίτημα με το συγκεκριμένο ID.";
            }

            $stmt->close();
        } else {
            echo "Δε βρέθηκε ID αιτήματος.";
        }
       // Close the connection
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
$conn->close();
 ?>
    </div>
</body>
</html>
<<<<<<< HEAD

=======
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
