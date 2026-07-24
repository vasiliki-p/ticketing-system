<?php
    $servername = "mysql-ticketing-system.alwaysdata.net";
    $username = "ticketing-system";
    $password = "24RCCDSchE_Psc2";
    $dbname = "ticketing-system_db";

    // Δημιουργία σύνδεσης
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);}


        echo  "Connected successfully";?>