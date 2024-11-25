<?php
// Start session and verify admin access
session_start();

if (!isset($_SESSION['nivel_acesso']) || $_SESSION['nivel_acesso'] != 3) {
    echo "Acesso negado. Apenas administradores podem acessar esta página.";
    exit();
}

// Include the database connection
require 'db.php';

// Fetch all users with proper role labels
try {
    $stmt = $conn->query("
        SELECT id_funcionario AS id, nome, 
               CASE 
                   WHEN nivel_acesso = 1 THEN 'Atendente' 
                   WHEN nivel_acesso = 2 THEN 'Gerente' 
                   WHEN nivel_acesso = 3 THEN 'Administrador' 
               END AS tipo
        FROM funcionarios
        UNION ALL
        SELECT id_cliente AS id, nome, 'Cliente' AS tipo 
        FROM clientes
    ");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Erro ao buscar usuários: " . $e->getMessage();
    exit();
}

// Handle user deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $delete_type = $_POST['delete_type'];

    $table = ($delete_type === 'Cliente') ? 'clientes' : 'funcionarios';

    try {
        $stmt = $conn->prepare("DELETE FROM $table WHERE id_" . ($delete_type === 'Cliente' ? 'cliente' : 'funcionario') . " = :id");
        $stmt->bindParam(':id', $delete_id);
        $stmt->execute();
        header("Location: pagina_index_admin.php");
        exit();
    } catch (Exception $e) {
        echo "Erro ao deletar usuário: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Área do administrador</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="pagina-admin">
    <h1>Lista de Usuários</h1>
    <a href="pagina_login.html">Login</a>
    
    <table class="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']); ?></td>
                    <td><?= htmlspecialchars($user['nome']); ?></td>
                    <td><?= htmlspecialchars($user['tipo']); ?></td>
                    <td>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="delete_id" value="<?= $user['id']; ?>">
                            <input type="hidden" name="delete_type" value="<?= $user['tipo']; ?>">
                            <button type="submit" class="btn-delete">Deletar</button>
                        </form>
                        <?php if ($user['tipo'] === 'Cliente'): ?>
                            <a href="pagina_edicao.php?id=<?= $user['id']; ?>" class="btn-edit">Editar</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>
