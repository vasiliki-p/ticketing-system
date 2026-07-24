<?php
include 'user_id login.php';
include 'connection.php';
include 'user_style.html';

$search_query = "";

// Έλεγχος αν υπάρχει η παράμετρος search
if (isset($_POST['search']) && !empty($_POST['search'])) {
    $search_query = $conn->real_escape_string($_POST['search']);

    // Εκτέλεση ερωτημάτων για τον πίνακα requests
    $results = [];

    // Ερώτημα για τα αιτήματα
    $sql_requests = "
        SELECT 'request' AS source, id, name, request AS content, created_at 
        FROM requests 
        WHERE user_id = '$user_id' 
        AND (name LIKE '%$search_query%' OR request LIKE '%$search_query%' OR title LIKE '%$search_query%')
    ";
    $result_requests = $conn->query($sql_requests);
    if ($result_requests && $result_requests->num_rows > 0) {
        while ($row = $result_requests->fetch_assoc()) {
            $results[] = $row;
        }
    } else {
        echo "Error in requests query: " . $conn->error;
    }

    // Ερώτημα για τις απαντήσεις
    $sql_answers = "
        SELECT 'answer' AS source, answer_id AS id, CONCAT(answers.user_answer, ' ', answers.admin_answer) AS name, CONCAT(answers.user_answer, ' ', answers.admin_answer) AS content, created_at 
        FROM answers 
        WHERE CONCAT(answers.user_answer, ' ', answers.admin_answer) LIKE '%$search_query%'
    ";
    $result_answers = $conn->query($sql_answers);
    if ($result_answers && $result_answers->num_rows > 0) {
        while ($row = $result_answers->fetch_assoc()) {
            $results[] = $row;
        }
    } else {
        echo "Error in answers query: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <style>
        .request-container {
            margin: 20px;
        }
        .request-box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="request-container">
        <?php
        // Εμφάνιση αποτελεσμάτων
        if (isset($results) && !empty($results)) {
            echo "<h2>Αποτελέσματα έρευνας</h2>";
            echo "<p>Αναζήτηση: <strong>" . htmlspecialchars($search_query, ENT_QUOTES, 'UTF-8') . "</strong></p>";
            foreach ($results as $result) {
                echo "<div class='request-box'>";
                if ($result['source'] === 'request') {
                    echo "<a href='request.php?id={$result['id']}'> " . htmlspecialchars($result['name'], ENT_QUOTES, 'UTF-8') . "</a><br>";
                } elseif ($result['source'] === 'answer') {
                    echo "<a href='answer.php?id={$result['id']}'> " . htmlspecialchars($result['name'], ENT_QUOTES, 'UTF-8') . "</a><br>";
                }
                echo "<p>" . htmlspecialchars($result['content'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p> " . htmlspecialchars($result['created_at'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "</div><br>";
            }
        } else {
            echo "Δεν βρέθηκαν αποτελέσματα.";
        }
        ?>
    </div>
</body>
</html>
