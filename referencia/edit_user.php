<?php
// Start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Include the database connection file
require 'db.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $userId = $_POST['id'];

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $cpf = $_POST['cpf'];
    $birth_date = $_POST['birth_date'];
    $email = $_POST['email'];

    // Update user data in the users table
    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare("UPDATE users SET name = ?, phone = ?, cpf = ?, birth_date = ?, email = ? WHERE id = ?");

        // Bind parameters and execute the query
        $stmt->execute([$name, $phone, $cpf, $birth_date, $email, $userId]);

        echo "User information updated successfully!";

        // Optionally, redirect to another page after update
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        // Handle any errors
        echo "Failed to update user information: " . $e->getMessage();
    }
}

// Close the database connection
$conn = null;
?>
