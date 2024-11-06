<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db.php';
session_start();

// Check if the user has admin access
if ($_SESSION['access_type'] != 'admin') {
    http_response_code(403);
    echo json_encode(['message' => 'Access denied']);
    exit();
}

// Check if it's a POST request and the DELETE method is simulated
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['_method'] == 'DELETE') {
    $userId = $_POST['id'] ?? null;
    
    if ($userId) {
        try {
            $conn->beginTransaction();

            // Delete from login table
            $stmt = $conn->prepare('DELETE FROM login WHERE user_id = ?');
            $stmt->execute([$userId]);

            // Delete from users table
            $stmt = $conn->prepare('DELETE FROM users WHERE id = ?');
            $stmt->execute([$userId]);

            $conn->commit();
            echo json_encode(['message' => 'User deleted successfully']);
        } catch (Exception $e) {
            $conn->rollBack();
            echo json_encode(['message' => 'Failed to delete user: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['message' => 'Invalid user ID']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['message' => 'Invalid request method']);
}
?>
