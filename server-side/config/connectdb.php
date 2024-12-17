<?php
$host = 'localhost';
$user = 'root'; 
$password = ''; 
$dbname = 'NaluriDatabase'; 

// Create a connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
}
?>
