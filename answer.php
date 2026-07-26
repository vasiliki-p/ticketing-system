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

 <?php
// 1. ΚΑΤΑΧΩΡΗΣΗ ΤΗΣ ΑΠΑΝΤΗΣΗΣ
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['id'], $_POST['answer'])) {
        $request_id = $_POST['id'];
        $user_answer = $_POST['answer']; 

        // Κάνουμε UPDATE τον πίνακα requests
        $stmt = $conn->prepare("UPDATE requests SET answer = ? WHERE id = ?");
        $stmt->bind_param("si", $user_answer, $request_id);

        if ($stmt->execute()) {
            echo "<p style='color: green; font-weight: bold;'>Η απάντηση καταχωρήθηκε επιτυχώς.</p>";
            // Ανακατεύθυνση πίσω στα αιτήματα
            echo "<script>window.location.href = 'my_requests.php';</script>";
            exit();
        } else {
            echo "<p style='color: red;'>Συνέβη κάποιο σφάλμα κατά την καταχώρηση της απάντησης.</p>";
        }
        $stmt->close();
    } else {
        echo "Δε βρέθηκαν απαραίτητα πεδία.";
    }
 }
 
// 2. ΕΜΦΑΝΙΣΗ ΤΟΥ ΑΙΤΗΜΑΤΟΣ ΚΑΙ ΤΗΣ ΦΟΡΜΑΣ
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Διαβάζει τα δεδομένα απευθείας από τον πίνακα requests
    $stmt = $conn->prepare("
        SELECT requests.id AS request_id, requests.title, requests.request, requests.created_at, requests.name, requests.answer, users.username
        FROM requests  
        LEFT JOIN users ON users.user_id = requests.user_id
        WHERE requests.id = ? 
    ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        echo "<div class='container'>";
        echo "<div class='header-box'>";  
        echo "<span style='margin-right: 20px;'><strong>Θέμα:</strong> " . htmlspecialchars($row['title']) . "</span>";
        echo "<span style='margin-right: 20px;'><strong>Όνομα:</strong> " . htmlspecialchars($row['name']) ."</span>";
        echo "<span style='margin-right: 20px;'><strong>Ημερομηνία Δημιουργίας:</strong> " . $row['created_at'] . "</span>";
        echo "<br><br>";
        echo "<p>" . nl2br(htmlspecialchars($row['request'])) . "</p>";
        echo "</div>";             
        
        echo "<div class='answers-box'>";
        if (!empty($row['answer'])) {
            echo "<p><strong>Απάντηση: </strong><br> " . nl2br(htmlspecialchars($row['answer'])) . "</p>";
        } else {
            echo "<p><em>Δεν έχει δοθεί απάντηση ακόμα.</em></p>";
        }
        echo "</div>";

        echo "<form method='post'>";
        echo "<p><strong>Νέα Απάντηση / Επεξεργασία:</strong>";
        echo " <input type='submit' value='Καταχώρηση'></p>";
        echo "<div>";
        echo "<input type='hidden' name='id' value='" . htmlspecialchars($id) . "'>";
        echo "<textarea name='answer' rows='15' style='width: 100%; box-sizing: border-box;'>" . htmlspecialchars($row['answer'] ?? '') . "</textarea>";
        echo "</div>";
        echo "</form>";
        
        echo "</div>"; 
    } else {
        echo "Δεν βρέθηκε αίτημα με το συγκεκριμένο ID.";
    }
    $stmt->close();
} else {
    echo "Δεν δόθηκε ID αιτήματος.";
}
        
$conn->close();
?>
    </div>
</body>
</html>
