<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit();
}

$editingUserId = $_GET['id'];

// Include the database connection
require 'db.php';

// Fetch user details to pre-fill the form
try {
    $stmt = $conn->prepare("SELECT id_cliente, nome, cpf, endereco FROM clientes WHERE id_cliente = ?");
    $stmt->execute([$editingUserId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Usuário não encontrado!";
        exit();
    }
} catch (Exception $e) {
    echo "Erro ao buscar detalhes do usuário: " . $e->getMessage();
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $password = $_POST['password'] ?? '';
    $endereco = $_POST['endereco'] ?? '';

    // Prepare the update query
    try {
        $updateFields = "nome = ?, endereco = ?";
        $params = [$name, $endereco, $editingUserId];

        // Hash password if provided
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $updateFields .= ", senha = ?";
            array_splice($params, 2, 0, $hashedPassword); // Add password before ID
        }

        $stmt = $conn->prepare("UPDATE clientes SET $updateFields WHERE id_cliente = ?");
        $stmt->execute($params);

        echo "sucesso!";
        exit();
    } catch (Exception $e) {
        echo "Erro ao atualizar perfil: " . $e->getMessage();
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Página de edição</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="pagina-edicao">
    <div class="wrapper">
        <form action="pagina_edicao.php?id=<?= htmlspecialchars($editingUserId); ?>" method="post">
            <h1>Editar Perfil</h1>

            <h3>Editando usuário de CPF:</h3>
            <h2><?= htmlspecialchars($user['cpf']); ?></h2>

            <!-- Name -->
            <div class="input-box">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['nome']); ?>">
            </div>

            <!-- Password -->
            <div class="input-box">
                <label for="password">Senha (deixe em branco para não alterar):</label>
                <input type="password" id="password" name="password">
            </div>

            <!-- Endereço -->
            <div class="input-box">
                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" value="<?= htmlspecialchars($user['endereco']); ?>">
            </div>

            <button type="submit" class="btn">Salvar Alterações</button>
        </form>
    </div>
</body>

</html>
