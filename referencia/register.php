<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (
        isset($_POST['username'], $_POST['password'], $_POST['name'], $_POST['phone'], $_POST['cpf'],
            $_POST['birth_date'], $_POST['email'], $_POST['access_type'])
    ) {
        // Get the input values
        $username = $_POST['username'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $cpf = $_POST['cpf'];
        $birth_date = $_POST['birth_date'];
        $email = $_POST['email'];
        $access_type = $_POST['access_type'];

        // Hash the password before storing
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Begin a transaction to ensure atomicity
        $conn->beginTransaction();

        try {
            // Insert into users table
            $stmt = $conn->prepare("INSERT INTO users (name, phone, cpf, email, birth_date) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $phone, $cpf, $email, $birth_date]);

            // Get the last inserted user ID
            $userId = $conn->lastInsertId();

            // Insert into login table with the hashed password
            $stmt = $conn->prepare("INSERT INTO login (username, password, user_id, access_type) VALUES (?, ?, ?, ?)");
            $stmt->execute([$username, $hashed_password, $userId, $access_type]);

            // Commit the transaction
            $conn->commit();

            // Redirect to login page
            header("Location: login.html");
            exit();
        } catch (Exception $e) {
            // Rollback the transaction if an error occurred
            $conn->rollBack();
            echo "Failed to register: " . $e->getMessage();
        }
    } else {
        echo "All fields are required!";
    }
}

// Close the database connection
$conn = null;
?>
