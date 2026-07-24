<?php
include 'user_id login.php';
include 'connection.php';
include 'style.html';

$search_query = "";

if (isset($_POST['search']) && !empty($_POST['search'])) {
  $search_query = $conn->real_escape_string($_POST['search']);

  // Εκτέλεση ερωτημάτων για τον πίνακα requests
  $results = [];

  // Ερώτημα για τους χρήστες
  $sql_users = "SELECT 'user' AS source, user_id AS id, name, lastname AS content FROM users WHERE user_id = '$user_id' AND (CONCAT(name, ' ', lastname) LIKE '%$search_query%' OR username LIKE '%$search_query%')";
  $result_users = $conn->query($sql_users);
  if ($result_users && $result_users->num_rows > 0) {
    while ($row = $result_users->fetch_assoc()) {
      $results[] = $row;
    }
  }
  
  // Ερώτημα για τις εταιρίες
  $sql_company = "SELECT 'company' AS source, company_code AS id, company_name AS name, description AS content FROM company WHERE company_name LIKE '%$search_query%' OR description LIKE '%$search_query%'";
  $result_company = $conn->query($sql_company);
  if ($result_company && $result_company->num_rows > 0) {
    while ($row = $result_company->fetch_assoc()) {
      $results[] = $row;
    }
  }
  
  // Ερώτημα για τα τμήματα
  $sql_department = "SELECT 'department' AS source, department_name AS id, department_name AS name FROM department WHERE department_name LIKE '%$search_query%'";
  $result_department = $conn->query($sql_department);
  if ($result_department && $result_department->num_rows > 0) {
    while ($row = $result_department->fetch_assoc()) {
      $results[] = $row;
    }
  }
  
  // Ερώτημα για τα αιτήματα
  $sql_requests = "SELECT 'request' AS source, id, name, request AS content FROM requests WHERE user_id = '$user_id' AND (name LIKE '%$search_query%' OR request LIKE '%$search_query%' OR title LIKE '%$search_query%')";
  $result_requests = $conn->query($sql_requests);
  if ($result_requests && $result_requests->num_rows > 0) {
    while ($row = $result_requests->fetch_assoc()) {
      $results[] = $row;
    }
  }

  // Ερώτημα για τις απαντήσεις
  $sql_answers = "SELECT 'answer' AS source, CONCAT(answers.user_answer, ' ', answers.admin_answer) AS name, CONCAT(answers.user_answer, ' ', answers.admin_answer) AS content FROM answers WHERE CONCAT(answers.user_answer, ' ', answers.admin_answer) LIKE '%$search_query%'";
  $result_answers = $conn->query($sql_answers);
  if ($result_answers && $result_answers->num_rows > 0) {
    while ($row = $result_answers->fetch_assoc()) {
      $results[] = $row;
    }
  }

  // Ερώτημα για τους ρόλους
  $sql_roles = "SELECT 'roles' AS source, role_name AS id, role_name AS name FROM roles WHERE role_name LIKE '%$search_query%'";
  $result_roles = $conn->query($sql_roles);
  if ($result_roles && $result_roles->num_rows > 0) {
    while ($row = $result_roles->fetch_assoc()) {
      $results[] = $row;
    }
  }
}
?>
<!DOCTYPE html>
<html>
   
<body>
     
<div class="request-container">
<?php
// Εμφάνιση αποτελεσμάτων
if (isset($results) && !empty($results)) {
  echo "<h2>Αποτελέσματα έρευνας</h2>";
  echo "<p>Αναζήτηση:<strong> " . htmlspecialchars($search_query, ENT_QUOTES, 'UTF-8') . "</strong></p>";
  foreach ($results as $result) {
    echo "<div class='request-box'>";
    if (isset($result['id'])) {
      if ($result['source'] === 'user') {
        echo "<a href='request.php?id={$result['id']}'>Χρήστης</a>";
      } elseif ($result['source'] === 'company') {
        echo "<a href='answer.php?id={$result['id']}'>Εταιρεία</a>";
      } elseif ($result['source'] === 'department') {
        echo "<a href='request.php?id={$result['id']}'>Τμήμα</a>";
      } elseif ($result['source'] === 'role') {
        echo "<a href='answer.php?id={$result['id']}'>Θέση</a>";
      } elseif ($result['source'] === 'request') {
        echo "<a href='request.php?id={$result['id']}'>Αίτημα</a>";
      } elseif ($result['source'] === 'answer') {
        echo "<a href='answer.php?id={$result['id']}'>Απάντηση</a>";
      }
      echo "</div><br>";
    }
  }
} else {
  echo "Δεν βρέθηκαν αποτελέσματα.";
}
?>
</div>

</body>
</html>
