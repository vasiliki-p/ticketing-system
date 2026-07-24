<?php


// Define the number of items per page
$items_per_page = 10; // Αριθμός αιτημάτων ανά σελίδα

// Modify the SQL query to include LIMIT clause
$sql = "SELECT id, name, email, title, completed FROM requests ORDER BY created_at DESC";
$result = $conn->query($sql);

// Check if there are results before trying to fetch them
if ($result !== false && $result->num_rows > 0) {
    // Calculate total number of pages
    $total_pages = ceil($result->num_rows / $items_per_page);
    
    // Check if page parameter is set, otherwise set it to 1
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    
    // Calculate the offset
    $offset = ($current_page - 1) * $items_per_page;
    
    // Modify the SQL query to include LIMIT clause
    $sql .= " LIMIT $offset, $items_per_page";
    $result = $conn->query($sql);

    // Output data of each row
    echo "<div class='request-container'>";
    echo "<h1>Αιτήματα</h1>";
    while($row = $result->fetch_assoc()) {
        // Output each request as before
    }
    echo "</div>";

    // Output pagination links
    echo "<div class='pagination'>";
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
            echo "<span class='current_page'>$i</span>";
        } else {
            echo "<a href='?page=$i'>$i</a>";
        }
    }
    echo "</div>";
} else {
    echo "<div class='request-container'>";
    echo "<h1>Αιτήματα</h1>";
    echo "Δεν βρέθηκαν αιτήματα.";
    echo "</div>";
}

// Close connection
$conn->close();
?>
