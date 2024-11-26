<!DOCTYPE html>
<html>

<head>
    <title>Área do cliente</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body class="pagina-cliente">

    <h1>Área do cliente</h1>
    <a href="pagina_avisos.php">Acessar painel de avisos</a>
    <p> - </p>
    <a href="pagina_pedido.php">Fazer pedido</a>
    <p> - </p>
    <a href="pagina_edicao.php?id=<?= $SESSION_['id']; ?>" class="btn-edit">Editar credenciais</a>
</body>

</html>