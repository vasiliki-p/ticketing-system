<?php
include 'answers_list.html';

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

// Query to select titles from requests table
$sql = "SELECT id, title FROM requests WHERE request != '' ORDER BY created_at DESC"; // Modified query
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Απαντήσεις</title>
</head>
<body>
    <div class="reg-form">
        <h1>Απαντήσεις</h1>
        
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<p><h3><a href='answers.php?id=" . htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row["title"], ENT_QUOTES, 'UTF-8') . "</a>";            
                echo "<label for='delete' style='margin-left: 20px;'><i class='fas fa-trash-alt' style='cursor:pointer; color:black;' onclick='deleteAnswer(" . htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8') . ")'></i></label></h3></p>";
                echo "</div>";
            }
        } else {
            echo "Δεν βρέθηκαν απαντήσεις.";
        }
        ?>
    </div>

    <script>
    function deleteAnswer(id) {
        if (confirm("Είστε σίγουρος ότι θέλετε να διαγράψετε αυτό το αίτημα;")) {
            console.log("Deleting answer with id:", id); // Debugging line
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4) {
                    if (this.status == 200) {
                        console.log("Answer deletion successful:", this.responseText); // Debugging line
                        window.location.reload(); // Refresh the page or update the list of requests
                    } else {
                        console.error("Answer deletion failed:", this.status, this.statusText); // Debugging line
                    }
                }
            };
            xhttp.open("GET", "delete_answers.php?id=" + encodeURIComponent(id), true);
            xhttp.send();
        }
    }
    </script>

    <?php
    // Close connection
    $conn->close();
    ?>
</body>
</html>

