
<?php
include 'user_id login.php';
include 'connection.php';
include 'answer css.html';

?>

<!DOCTYPE html>
<html>
<head>
<title>Καταχώρηση Απάντησης</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
           echo "<script>window.location.href = 'my_requests.php';</script>";
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
 
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Query to select details of the request
            $stmt = $conn->prepare("SELECT requests.id AS request_id, requests.title, requests.request, requests.created_at,requests.name, concat( answers.user_answer,' ', answers.admin_answer)  as answers, users.username
            FROM requests  
            LEFT JOIN answers ON requests.id = answers.request_id 
            LEFT JOIN users ON users.user_id = answers.user_id
            WHERE requests.id = ? 
            ");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($result->num_rows > 0) {
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

$conn->close();
 ?>
    </div>
</body>
</html>

