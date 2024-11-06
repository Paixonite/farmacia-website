<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$userId = $_GET['id'] ?? null;

// Include the database connection file
require 'db.php';

// Fetch current user details to pre-fill the form
try {
    $stmt = $conn->prepare("SELECT name, phone, cpf, birth_date, email FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$user) {
        echo "User not found!";
        exit();
    }
} catch (Exception $e) {
    echo "Error fetching user details: " . $e->getMessage();
    exit();
}

// Close the database connection
$conn = null;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit page</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body class="edit-page">
    <div class="wrapper">
        <form action="edit_user.php" method="post">
            <h1>Edit profile</h1>

            <!-- Hidden field to pass the user ID -->
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($userId); ?>">

            <h5>Name:</h5>
            <div class="input-box">
                <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            <h5>Phone:</h5>
            <div class="input-box">
                <input type="tel" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
            </div>
            <h5>CPF:</h5>
            <div class="input-box">
                <input type="text" name="cpf" value="<?php echo htmlspecialchars($user['cpf']); ?>" required>
            </div>
            <h5>Birth Date:</h5>
            <div class="input-box">
                <input type="date" name="birth_date" value="<?php echo htmlspecialchars($user['birth_date']); ?>" required>
            </div>
            <h5>Email:</h5>
            <div class="input-box">
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            
            <button type="submit" class="btn">Submit</button>
        </form>
    </div>
</body>

</html>
