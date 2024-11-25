<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Start the session
session_start();

// Include the database connection
require 'db.php';

// Fetch all alerts from the database
$stmt = $conn->prepare("SELECT id_alerta, titulo, mensagem FROM alertas");
$stmt->execute();
$alertas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if the user is a gerente
$isGerente = isset($_SESSION['nivel_acesso']) && $_SESSION['nivel_acesso'] == 2;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle delete request
    if (isset($_POST['delete_id']) && $isGerente) {
        $deleteId = $_POST['delete_id'];

        $deleteStmt = $conn->prepare("DELETE FROM alertas WHERE id_alerta = :id_alerta");
        $deleteStmt->bindParam(':id_alerta', $deleteId, PDO::PARAM_INT);

        if ($deleteStmt->execute()) {
            header("Location: pagina_avisos.php");
            exit();
        } else {
            echo "Erro ao excluir o alerta!";
        }
    }

    // Handle add request
    if (isset($_POST['titulo']) && isset($_POST['mensagem']) && $isGerente) {
        $titulo = $_POST['titulo'];
        $mensagem = $_POST['mensagem'];

        $insertStmt = $conn->prepare("INSERT INTO alertas (titulo, mensagem) VALUES (:titulo, :mensagem)");
        $insertStmt->bindParam(':titulo', $titulo);
        $insertStmt->bindParam(':mensagem', $mensagem);

        if ($insertStmt->execute()) {
            echo "Sucesso!";
            header("Location: pagina_avisos.php");
            exit();
        } else {
            echo "Erro ao adicionar o alerta!";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Painel de avisos</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="pagina-avisos">
    <div class="pagina-avisos-links">
        <a href="pagina_index_funcionario.html">Área do funcionário</a>
        <p>-</p>
        <a href="pagina_index_cliente.html">Área do cliente</a>
        <p>-</p>
        <a href="pagina_login.html">Login</a> 
    </div>
    <div class="container">
        <h1>Painel de avisos</h1>

        <div class="alertas">
            <?php if (!empty($alertas)): ?>
                <?php foreach ($alertas as $alerta): ?>
                    <div class="alerta">
                        <h2><?= htmlspecialchars($alerta['titulo']) ?></h2>
                        <p><?= htmlspecialchars($alerta['mensagem']) ?></p>
                        <?php if ($isGerente): ?>
                            <form method="POST" class="delete-form">
                                <input type="hidden" name="delete_id" value="<?= $alerta['id_alerta'] ?>">
                                <button type="submit" class="delete-button">Excluir</button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum aviso disponível no momento.</p>
            <?php endif; ?>
        </div>
        <?php if ($isGerente): ?>
            <div class="adicionar">
                <h2>Adicionar aviso</h2>
                <form method="POST" class="adicionar-form">
                    <div class="input-box">
                        <label for="titulo">Título:</label>
                        <input type="text" id="titulo" name="titulo" placeholder="Título do aviso" required>
                    </div>
                    <div class="input-box">
                        <label for="mensagem">Mensagem:</label>
                        <textarea id="mensagem" name="mensagem" placeholder="Mensagem do aviso" required></textarea>
                    </div>
                    <button type="submit" class="adicionar-button">Adicionar</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
