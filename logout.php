<?php
// Ξεκινάμε τη συνεδρία
session_start();

// Καταστρέφουμε τη συνεδρία
session_unset();
session_destroy();

// Ανακατεύθυνση του χρήστη στη σελίδα σύνδεσης 
<<<<<<< HEAD
header("Location: index.php");
=======
header("Location: login.php");
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
exit;
?>
