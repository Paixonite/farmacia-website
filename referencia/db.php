<?php
$servername = "localhost";
$username = "paixas";
$password = "12345";
$dbname = "user_data";

try {
    // Create a PDO instance (connect to the database)
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception for better error handling
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully"; 

} catch(PDOException $e) {
    // If the connection fails, output an error
    die("Connection failed: " . $e->getMessage());
}
?>
