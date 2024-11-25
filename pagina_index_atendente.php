<?php
// Start session and verify atendente access
session_start();

if (!isset($_SESSION['nivel_acesso']) || $_SESSION['nivel_acesso'] != 1) {
    echo "Acesso negado. Apenas atendentes podem acessar esta página.";
    exit();
}

// Include the database connection
require 'db.php';

// Fetch all clients
try {
    $stmt = $conn->query("SELECT id_cliente, nome FROM clientes");
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Erro ao buscar clientes: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Área do atendente</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="pagina-atendente">
    <h1>Lista de Clientes</h1>
    <a href="pagina_login.html">Login</a>
    <table class="client-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client): ?>
                <tr>
                    <td><?= htmlspecialchars($client['id_cliente']); ?></td>
                    <td><?= htmlspecialchars($client['nome']); ?></td>
                    <td>
                        <a href="pagina_pedido.php?id_cliente=<?= $client['id_cliente']; ?>" class="btn-order">Fazer Pedido</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>
