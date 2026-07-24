<?php
<<<<<<< HEAD
include 'restricted.php';
include 'requests css.html';
include 'connection.php';

// Get the items per page from the query string or set default to 10
$items_per_page = isset($_GET['items_per_page']) ? intval($_GET['items_per_page']) : 10;

// Get the current page number from the query string, default to 1 if not present
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $items_per_page;

// Get the total number of items
$status_filter = isset($_GET['status_filter']) ? $_GET['status_filter'] : 'all';

$total_items_sql = "SELECT COUNT(*) as count FROM requests";

$total_items_result = $conn->query($total_items_sql);
$total_items_row = $total_items_result->fetch_assoc();
$total_items = $total_items_row['count'];

// Calculate the total number of pages
$total_pages = ceil($total_items / $items_per_page);

$sql = "SELECT id, name, username, email, title, created_at, IF(completed IS NULL, 0, completed) AS completed FROM requests";

// Προσθήκη φίλτρου κατάστασης στο ερώτημα SQL
if ($status_filter == 'completed') {
    $sql .= " WHERE completed = 1";
} elseif ($status_filter == 'uncompleted') {
    $sql .= " WHERE completed = 0 OR completed IS NULL";
}

$sql .= " ORDER BY created_at DESC LIMIT $items_per_page OFFSET $offset";

$result = $conn->query($sql);
=======
include 'requests css.html';
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

>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
=======
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
    <title>Αιτήματα</title>
</head>
<body>
<div class="request-container">
<<<<<<< HEAD
    <div class="header-container">
        <h1>Αιτήματα</h1>
        <div class="items-per-page">
            <form action="" method="GET">
                <label for="items_per_page">Αιτήματα ανά σελίδα:</label>
                <select name="items_per_page" id="items_per_page" onchange="this.form.submit()">
                    <option value="10" <?php if ($items_per_page == 10) echo 'selected'; ?>>10</option>
                    <option value="20" <?php if ($items_per_page == 20) echo 'selected'; ?>>20</option>
                    <option value="50" <?php if ($items_per_page == 50) echo 'selected'; ?>>50</option>
                    <option value="100" <?php if ($items_per_page == 100) echo 'selected'; ?>>100</option>
                </select>
                <input type="hidden" name="page" value="<?php echo $current_page; ?>">
         
                <br>
   
                <label for="status_filter">Φίλτρο κατάστασης:</label>
                <select name="status_filter" id="status_filter" onchange="this.form.submit()">
                    <option value="all" <?php if ($status_filter == 'all') echo 'selected'; ?>>Όλα</option>
                    <option value="completed" <?php if ($status_filter == 'completed') echo 'selected'; ?>>Ολοκληρωμένα</option>
                    <option value="uncompleted" <?php if ($status_filter == 'uncompleted') echo 'selected'; ?>>Μη ολοκληρωμένα</option>
                </select>
                <input type="hidden" name="page" value="<?php echo $current_page; ?>">
                
            </form>

        </div>
    </div>
    <input type="hidden" name="status_filter" value="<?php echo $status_filter; ?>">

    <?php
=======
    <h1>Αιτήματα</h1>
    <?php
    // Query to select titles from requests table
    
    $sql = "SELECT id, name, email, title, completed FROM requests ORDER BY created_at DESC";
    $result = $conn->query($sql);

>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
    // Output data of each row
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<h3><a href='answer_form.php?id=" . $row["id"]. "'>" . $row["title"]. "</a>";
<<<<<<< HEAD
            echo "<p></p>";
            //echo "<span style='margin-left: 20px;'>"; // Προσθήκη ενδιάμεσου κενού
             // Έλεγχος αν το checkbox είναι επιλεγμένο ή όχι
            $checked = $row["completed"] == 1 ? "checked" : "";
            echo "<label for='completed'>Ολοκληρωμένο: </label>";
            echo "<input type='checkbox' id='completed' name='completed' value='1' $checked onchange='updateCompleted(this, " . $row["id"] . ")'>";
            echo "<label for='delete' style='margin-left: 20px;'><i class='fas fa-trash-alt' style='cursor:pointer; color:#FF7613;' onclick='deleteRequest(" . $row["id"] . ")'></i></label></h3></p>";
            echo "<div class='request-box'>";  
            echo "<p>Ονοματεπώνυμο: " . $row["name"]. "</p>";
            echo "<p>Username: " . $row["username"]. "</p>";
            echo "<p>Ημερομηνία Δημιουργίας: " . $row["created_at"]. "</p>";
=======
            echo "<span style='margin-left: 20px;'>"; // Προσθήκη ενδιάμεσου κενού
             // Έλεγχος αν το checkbox είναι επιλεγμένο ή όχι
            $checked = $row["completed"] == 1 ? "checked" : "";
            echo "<input type='checkbox' id='completed' name='completed' value='1' $checked onchange='updateCompleted(this, " . $row["id"] . ")'></h3></p>";
            echo "<div class='request-box'>";  
            echo "<p>Ονοματεπώνυμο: " . $row["name"]. "</p>";
            echo "<p>Email: " . $row["email"]. "</p>";
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
            echo "</div>";
            echo "</div>";
            echo "<p></p>";
        }
    } else {
        echo "Δεν βρέθηκαν αιτήματα.";
    }
    ?>
</div>

<<<<<<< HEAD
<div class="pagination">
    <?php
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
            echo "<span class='current_page'>$i</span>";
        } else {
            echo "<a href='?page=$i&items_per_page=$items_per_page&status_filter=$status_filter'>$i</a>";
        }
    }
    ?>
</div>

<script>
    function deleteRequest(id) {
    if (confirm("Είστε σίγουρος ότι θέλετε να διαγράψετε αυτό το αίτημα;")) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Check for successful response
                if (this.responseText.trim() === "success") {
                    console.log("Το αίτημα διαγράφηκε επιτυχώς.");
                    window.location.reload();
                } else {
                    console.error("Σφάλμα κατά τη διαγραφή του αιτήματος: " + this.responseText);
                }
            }
        };
        xhttp.open("GET", "delete_request.php?id=" + id, true);
        xhttp.send();
    }
}
</script>
<script src="update_completed.js"></script>
=======
<script>
function updateCompleted(checkbox, id) {
    var completed = checkbox.checked ? 1 : 0;

    // Παράδειγμα AJAX ερώτησης
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Επιτυχής αποθήκευση στη βάση δεδομένων
            console.log("Η κατάσταση του αιτήματος ενημερώθηκε επιτυχώς.");
        }
    };
    xhttp.open("GET", "update_completed.php?id=" + id + "&completed=" + completed, true);
    xhttp.send();
}
</script>

</body>
</html>

>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the completed checkbox is checked
    $completed = isset($_POST['completed']) ? 1 : 0;

    // Insert new record with the completed status
    $stmt = $conn->prepare("INSERT INTO requests (completed) VALUES (?)");
    $stmt->bind_param("i", $completed);

    if ($stmt->execute()) {
        echo "Επιτυχής δημιουργία νέας εγγραφής";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close(); // Close the statement
}
// Close connection
$conn->close();
?>
<<<<<<< HEAD
</body>
</html>
=======
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
