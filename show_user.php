<?php
include 'restricted.php';
include 'connection.php';
include 'show_users css.html';

// Get the user_id from the query string
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

// Fetch user details from the database
$sql = "SELECT user_id, name, lastname, username, email, phone, company_code, department_name, role_name FROM users WHERE user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Στοιχεία Χρήστη</title>
</head>
<body>
<div class="request-container">
  <div class="header-container2">
    <h1>Στοιχεία Χρήστη</h1>
    <div><strong>Όνομα:</strong> <?php echo htmlspecialchars($user['name']); ?></div>
    <p><strong>Επώνυμο:</strong> <?php echo htmlspecialchars($user['lastname']); ?></p>
    <p><strong>Όνομα Χρήστη:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <p><strong>Τηλέφωνο:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
    <p><strong>Εταιρεία:</strong> <?php echo htmlspecialchars($user['company_code']); ?></p>
    <p><strong>Τμήμα:</strong> <?php echo htmlspecialchars($user['department_name']); ?></p>
    <p><strong>Θέση:</strong> <?php echo htmlspecialchars($user['role_name']); ?></p>

    <a href="show_users.php" class="btn btn-primary">Πίσω στην Λίστα Χρηστών</a>
  </div>
</div>
</body>
</html>


<?php
// Close connection
$conn->close();
?>

