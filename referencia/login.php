<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure username and password are set
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare the SQL statement to fetch user information including ID and access_type
        $stmt = $conn->prepare("SELECT user_id, password, access_type FROM login WHERE username = :username");
        $stmt->bindParam(':username', $username);

        // Execute the query
        $stmt->execute();

        // Fetch the result
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['password'])) {
            // Start the session
            session_start();
            session_unset();
            session_destroy();
            session_start();

            // Set session variables
            $_SESSION['user_id'] = $row['user_id'];  // User ID from the database
            $_SESSION['access_type'] = $row['access_type'];  // Access type from the database

            // Redirect to index.php
            header("Location: index.php");
            exit();
        } else {
            // Invalid credentials
            echo "Invalid username or password!";
        }
    } else {
        echo "Username and password are required!";
    }
}

// Close the database connection
$conn = null;

?>
