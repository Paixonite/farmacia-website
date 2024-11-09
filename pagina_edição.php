<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in
if (!isset($_SESSION['(?id)'])) {
    header("Location: login.html");
    exit();
}

$userId = $_GET['id'] ?? null;

// Include the database connection file
require 'db.php';

// Fetch current user details to pre-fill the form
try {
    $stmt = $conn->prepare("SELECT nome, cpf, endereço FROM clientes WHERE id = ?");
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
    <title>Página de edição</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body class="pagina-edição">
    <div class="wrapper">
        <form action="?.php" method="post">
            <h1>Editar perfil</h1>

            <!-- Hidden field to pass the user ID -->
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($userId); ?>">

            <h5>Nome:</h5>
            <div class="input-box">
                <input type="text" name="name" value="<?php echo htmlspecialchars($user['(?nome)']); ?>" required>
            </div>
            <h5>CPF:</h5>
            <div class="input-box">
                <input type="text" name="cpf" value="<?php echo htmlspecialchars($user['(?cpf)']); ?>" required>
            </div>
            <h5>Endereço</h5>
            <div class="input-box">
                <input type="date" name="birth_date" value="<?php echo htmlspecialchars($user['(?endereço)']); ?>" required>
            </div>
            
            <button type="submit" class="btn">Enviar</button>
        </form>
    </div>
</body>

</html>