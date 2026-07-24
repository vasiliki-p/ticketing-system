<?php
include 'restricted.php';
include 'show_users css.html'; 
include 'connection.php';

// Get the items per page from the query string or set default to 10
$items_per_page = isset($_GET['items_per_page']) ? intval($_GET['items_per_page']) : 10;

// Get the current page number from the query string, default to 1 if not present
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $items_per_page;

// Get the total number of items
$total_items_sql = "SELECT COUNT(*) as count FROM users";
$total_items_result = $conn->query($total_items_sql);

if (!$total_items_result) {
    die("Query failed: " . $conn->error);
}

$total_items_row = $total_items_result->fetch_assoc();
$total_items = $total_items_row['count'];

// Calculate the total number of pages
$total_pages = ceil($total_items / $items_per_page);

// Fetch users with prepared statement
$sql = "SELECT user_id, name, username, email FROM users ORDER BY user_id DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $items_per_page, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Χρήστες</title>
</head>
<body>
<div class="request-container">
    <div class="header-container">
        <h1>Χρήστες</h1>
        <div class="items-per-page">
            <form action="" method="GET">
                <label for="items_per_page">Χρήστες ανά σελίδα:</label>
                <select name="items_per_page" id="items_per_page" onchange="this.form.submit()">
                    <option value="10" <?php if ($items_per_page == 10) echo 'selected'; ?>>10</option>
                    <option value="20" <?php if ($items_per_page == 20) echo 'selected'; ?>>20</option>
                    <option value="50" <?php if ($items_per_page == 50) echo 'selected'; ?>>50</option>
                    <option value="100" <?php if ($items_per_page == 100) echo 'selected'; ?>>100</option>
                </select>
                <input type="hidden" name="page" value="<?php echo $current_page; ?>">
            </form>
        </div>
    </div>

    <?php
    // Output data of each row
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<h3><a href='show_user.php?user_id=" . $row["user_id"] . "'>". htmlspecialchars($row["name"]) . "</a>";
            echo "<label for='delete' style='margin-left: 20px;'><i class='fas fa-trash-alt' style='cursor:pointer; color:#FF7613;' onclick='deleteUser(" . $row["user_id"] . ")'></i></label></h3></p>";
            echo "</div>";
        }
    } else {
        echo "Δεν βρέθηκαν χρήστες.";
    }
    ?>
</div>

<script>
function deleteUser(user_id) {
    if (confirm("Είστε σίγουρος ότι θέλετε να διαγράψετε αυτόν το χρήστη;")) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Check for successful response
                if (this.responseText.trim() === "success") {
                    console.log("Ο χρήστης διαγράφηκε επιτυχώς.");
                    // Reload the current page to reflect changes
                    window.location.reload();
                } else {
                    console.error("Σφάλμα κατά τη διαγραφή του χρήστη: " + this.responseText);
                }
            }
        };
        xhttp.open("GET", "delete_user.php?user_id=" + user_id, true);
        xhttp.send();
    }
}
</script>

<div class="pagination">
    <?php
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
            echo "<span class='current_page'>$i</span>";
        } else {
            echo "<a href='?page=$i&items_per_page=$items_per_page'>$i</a>";
        }
    }
    ?>
</div>


<?php
// Close connection
$stmt->close();
$conn->close();
?>
</body>
</html>
