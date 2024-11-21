<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure nome and senha are set
    if (isset($_POST['nome']) && isset($_POST['senha'])) {
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];

        // Prepare the SQL statement to fetch user information including ID and nivel_acesso

        // a gente precisa resolver isso aqui
        $stmt = $conn->prepare("SELECT id, nome, senha FROM login WHERE nome = :nome");
        $stmt->bindParam(':nome', $nome);

        // Execute the query
        $stmt->execute();

        // Fetch the result
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && senha_verify($senha, $row['senha'])) {
            // Start the session
            session_start();
            session_unset();
            session_destroy();
            session_start();

            // Set session variables
            $_SESSION['id'] = $row['id'];  // User ID from the database
            $_SESSION['nivel_acesso'] = $row['nivel_acesso'];  // Access type from the database

            // Redirect to index.php
            // ou entao pro funcionario
            header("Location: pagina_index_cliente.html");
            exit();
        } else {
            // Invalid credentials
            echo "Nome ou senha inválidos!";
        }
    } else {
        echo "Nome e senha são obrigatórios!";
    }
}

// Close the database connection
$conn = null;

?>
