<?php
// Start the session
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Include the database connection file
require 'db.php';

// Fetch all users from the login table
$stmt = $conn->prepare("SELECT username, access_type, user_id FROM login");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Close the database connection
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Management</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="index-page">

<div class="links">
        <a href="login.html">login</a>
        <a href="register.html">register</a>
</div>
<div class="user-info">
    <h1>User List</h1>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Access Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Display each user
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . $user['username'] . "</td>";
                echo "<td>" . $user['access_type'] . "</td>";
                echo "<td>";

                // Check user access type from session
                $accessType = $_SESSION['access_type'] ?? null;
                $userId = $user['user_id']; // Use 'user_id' here

                // Show edit and delete buttons based on access type
                if (($accessType == "user" && $_SESSION['user_id'] == $userId) ||
                    ($accessType == "manager" && ($_SESSION['user_id'] == $userId || $user['access_type'] == "user"))) {
                    echo "<a href='edit_page.php?id=" . $userId . "'>EDIT</a>";
                } elseif ($accessType == "admin") {
                    echo "<a href='edit_page.php?id=" . $userId . "'>EDIT</a> ";
                    echo "<button onclick='deleteUser(" . $userId . ")'>DELETE</button>";
                } else {
                    echo "none";
                }

                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
   function deleteUser(userId) {
    console.log(`Attempting to delete user with ID: ${userId}`);  // Debugging log

    if (confirm('Are you sure you want to delete this user?')) {
        fetch('delete_user.php', {
            method: 'POST', // Simulate DELETE
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id=${userId}&_method=DELETE` // Pass ID and method
        })
        .then(response => {
            console.log(response.status); // Debugging: Check the status code
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data); // Debugging log for response
            if (data.message) {
                alert(data.message);
                location.reload(); // Reload the page after successful deletion
            } else {
                alert('Failed to delete user');
            }
        })
        .catch(error => console.error('Fetch error:', error));  // Debugging: Check for any fetch errors
    }
}
</script>

</body>
</html>
