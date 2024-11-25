<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure cpf and senha are set
    if (isset($_POST['cpf']) && isset($_POST['senha'])) {
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];

        // Check if the cpf exists in the funcionarios table
        $stmt = $conn->prepare("SELECT id_funcionario AS id, cpf, senha, nivel_acesso FROM funcionarios WHERE cpf = :cpf");
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();
        $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($funcionario) {
            // cpf found in funcionarios table, verify password
            if (password_verify($senha, $funcionario['senha'])) {
                // Start the session
                session_start();
                session_unset();
                session_destroy();
                session_start();

                // Set session variables for funcionario
                $_SESSION['id'] = $funcionario['id'];
                $_SESSION['nivel_acesso'] = $funcionario['nivel_acesso'];

                // Redirect to the specific index
                if($_SESSION['nivel_acesso'] == 1)
                    header("Location: pagina_index_atendente.php");
                if($_SESSION['nivel_acesso'] == 3)
                    header("Location: pagina_index_gerente.php");
                if($_SESSION['nivel_acesso'] == 3)
                    header("Location: pagina_index_admin.php");

                exit();
            } else {
                echo "Senha inválida!";
                exit();
            }
        }

        // Check if the cpf exists in the clientes table
        $stmt = $conn->prepare("SELECT id_cliente AS id, cpf, senha FROM clientes WHERE cpf = :cpf");
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cliente) {
            echo "CPF encontrado na tabela clientes.";
            // cpf found in clientes table, verify password
            if (password_verify($senha, $cliente['senha'])) {
                // Start the session
                session_start();
                session_unset();
                session_destroy();
                session_start();

                // Set session variables for cliente
                $_SESSION['id'] = $cliente['id'];

                // Redirect to the cliente index
                header("Location: pagina_index_cliente.html");
                exit();
            } else {
                echo "Senha inválida!";
                exit();
            }
        }

        // If cpf was not found in either table
        echo "cpf não encontrado!";
    } else {
        echo "cpf e senha são obrigatórios!";
    }
}

// Close the database connection
$conn = null;

?>
