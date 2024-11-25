<?php
// Start session and verify gerente access
session_start();

if (!isset($_SESSION['nivel_acesso']) || $_SESSION['nivel_acesso'] != 2) {
    echo "Acesso negado. Apenas gerentes podem acessar esta página.";
    exit();
}

// Include the database connection
require 'db.php';

// Handle product deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product_id'])) {
    try {
        $stmt = $conn->prepare("DELETE FROM produtos WHERE id_produto = ?");
        $stmt->execute([$_POST['delete_product_id']]);
        header("Location: pagina_index_gerente.php");
        exit();
    } catch (Exception $e) {
        echo "Erro ao deletar produto: " . $e->getMessage();
    }
}

// Handle product addition
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    try {
        $stmt = $conn->prepare("INSERT INTO produtos (nome, preco, descricao, quantidade) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $_POST['nome'],
            $_POST['preco'],
            $_POST['descricao'],
            $_POST['quantidade']
        ]);
        header("Location: pagina_index_gerente.php");
        exit();
    } catch (Exception $e) {
        echo "Erro ao adicionar produto: " . $e->getMessage();
    }
}

// Fetch all products
try {
    $stmt = $conn->query("SELECT * FROM produtos");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Erro ao buscar produtos: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Área do funcionário</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="pagina-gerente">
    <h1>Área do funcionário</h1>
    <h3>Você é um gerente!</h3>
    <a href="pagina_avisos.php">Painel de avisos</a>
    <p> - </p>
    <a href="pagina_historico.php">Histórico de pedidos</a>

    <h2>Lista de Produtos</h2>
    <table class="product-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['id_produto']); ?></td>
                    <td><?= htmlspecialchars($product['nome']); ?></td>
                    <td>R$ <?= number_format($product['preco'], 2, ',', '.'); ?></td>
                    <td><?= htmlspecialchars($product['descricao']); ?></td>
                    <td><?= htmlspecialchars($product['quantidade']); ?></td>
                    <td>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="delete_product_id" value="<?= $product['id_produto']; ?>">
                            <button type="submit" class="btn-delete">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Adicionar Produto</h2>
    <form method="POST" class="add-product-form">
        <input type="hidden" name="add_product" value="1">
        <div>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
        </div>
        <div>
            <label for="preco">Preço:</label>
            <input type="number" id="preco" name="preco" step="0.01" required>
        </div>
        <div>
            <label for="descricao">Descrição:</label>
            <input type="text" id="descricao" name="descricao" required>
        </div>
        <div>
            <label for="quantidade">Quantidade:</label>
            <input type="number" id="quantidade" name="quantidade" required>
        </div>
        <button type="submit" class="btn-add">Adicionar Produto</button>
    </form>
</body>

</html>
