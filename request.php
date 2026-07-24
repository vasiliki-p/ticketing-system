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


?>

<!DOCTYPE html>
<html>
<head>
<title>Καταχώρηση Απάντησης</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include your CSS file -->
       <link rel="stylesheet" type="text/css" href="answers_form css.html">

</head>
<body>
<?php include 'request css.html'; ?>

    <div class="answer_form">
<<<<<<< HEAD
        <h1>Λεπτομέρειες Αιτήματος</h1>
=======
        <h1><strong>Λεπτομέρειες Αιτήματος</strong></h1>
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b


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
            $stmt = $conn->prepare("SELECT id, title, request FROM requests WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($result->num_rows > 0) {
                echo "<p><strong>Θέμα:</strong> " . $row['title'] . "</p>";
                echo "<p><strong>Αίτημα:</strong> " . $row['request'] . "</p>";
                echo"</div>";
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
    </div>
</body>
</html>
