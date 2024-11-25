<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accountType = $_POST['account_type'] ?? '';

    // Common fields
    $nome = $_POST['nome'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    try {
        $conn->beginTransaction();

        if ($accountType === 'cliente') {
            $endereco = $_POST['endereco'] ?? '';

            $stmt = $conn->prepare("INSERT INTO clientes (nome, senha, cpf, endereco) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nome, $senha_hash, $cpf, $endereco]);
        } elseif ($accountType === 'funcionario') {
            $nivel_acesso = $_POST['nivel_acesso'] ?? '';

            $stmt = $conn->prepare("INSERT INTO funcionarios (nome, senha, cpf, nivel_acesso) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nome, $senha_hash, $cpf, $nivel_acesso]);
        } else {
            throw new Exception("Tipo de conta inválido.");
        }

        $conn->commit();
        echo "Registro realizado com sucesso!";
        header("Location: pagina_login.html");
        exit();
    } catch (Exception $e) {
        $conn->rollBack();
        echo "Erro no registro: " . $e->getMessage();
    }
}


// Close the database connection
$conn = null;
?>
