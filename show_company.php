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
$total_items_sql = "SELECT COUNT(*) as count FROM company";
$total_items_result = $conn->query($total_items_sql);
$total_items_row = $total_items_result->fetch_assoc();
$total_items = $total_items_row['count'];

// Calculate the total number of pages
$total_pages = ceil($total_items / $items_per_page);

$sql = "SELECT company_code, company_name, description FROM company ORDER BY company_code DESC LIMIT $items_per_page OFFSET $offset";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Εταιρείες</title>
</head>
<body>
<div class="request-container">
    <div class="header-container">
        <h1>Εταιρείες</h1>
        <div class="items-per-page">
            <form action="" method="GET">
                <label for="items_per_page">Εταιρείες ανά σελίδα:</label>
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
            echo "<h3>" . $row["company_name"] . "<label for='delete' style='margin-left: 20px;'><i class='fas fa-trash-alt' style='cursor:pointer; color:#FF7613;' onclick='deleteCompany(\"" . $row["company_code"] . "\")'></i></label></h3></p>";
            echo "<div class='request-box'>";  
            echo "<p>Κωδικός Εταιρείας: " . $row["company_code"] . "</p>";
            echo "<p>Περιγραφή: " . $row["description"] . "</p>";
            echo "</div>";
            echo "</div>";
            echo "<p></p>";
        }
    } else {
        echo "Δεν βρέθηκαν εταιρείες.";
    }
    ?>
</div>

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

<script>
 function deleteCompany(company_code) {
    if (confirm("Είστε σίγουρος ότι θέλετε να διαγράψετε αυτή την εταιρεία;")) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText); // Debugging: log the server response
                if (this.responseText.trim() === "success") {
                    console.log("Η εταιρεία διαγράφηκε επιτυχώς.");
                    window.location.reload(); // Refresh the page
                } else {
                    console.error("Σφάλμα κατά τη διαγραφή της εταιρείας: " + this.responseText);
                }
            }
        };
        xhttp.open("GET", "delete_company.php?company_code=" + company_code, true);
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
