<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #ffffffff;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #9dd496ff;
            padding: 20px;
            border-radius: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
            margin-bottom: 20px;
            border-radius: 10px;
            padding: 10px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .navbar a {
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
        }

        .btn-incluir {
            background-color: #4CAF50;
        }

        .btn-alterar {
            background-color: #2196F3;
        }

        .btn-excluir {
            background-color: #f44336;
        }

        .btn-consulta {
            background-color: #ff9800;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <a href="primeira_2026.php" class="btn-incluir">Incluir Pessoa</a>
        <a href="alterar.php" class="btn-alterar">Alterar Pessoa</a>
        <a href="excluir.php" class="btn-excluir">Excluir Pessoa</a>
        <a href="pedidos.php" class="btn-incluir">Novo Pedido</a>
        <a href="consulta.php" class="btn-consulta">Listar Pedidos</a>
    </div>

    <form class="container" method="post">
        <h1>Novo Pedido</h1>
        <div class="form-group">
            <label for="cadastro_idcadastro">Cliente (Cadastro)</label>
            <select name="cadastro_idcadastro" required>
                <option value="">Selecione um cliente</option>
                <?php
                // Conectar para buscar os clientes
                $server = "localhost";
                $user = "root";
                $password = "";
                $database = "cadastro";
                $port = "3308";
                $conn_clientes = new mysqli($server, $user, $password, $database, $port);

                if (!$conn_clientes->connect_error) {
                    $sql_clientes = "SELECT idcadastro, nome_cadastro, cpf FROM cadastro ORDER BY nome_cadastro ASC";
                    $result_clientes = $conn_clientes->query($sql_clientes);

                    if ($result_clientes && $result_clientes->num_rows > 0) {
                        while ($row = $result_clientes->fetch_assoc()) {
                            echo "<option value='" . $row['idcadastro'] . "'>" . $row['nome_cadastro'] . " (CPF: " . $row['cpf'] . ")</option>";
                        }
                    }
                    $conn_clientes->close();
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="nome_pedido">Nome Pedido</label>
            <input type="text" name="nome_pedido" required>
        </div>
        <div class="form-group">
            <label for="data_pedido">Data Pedido</label>
            <input type="date" name="data_pedido" required>
        </div>
        <div class="form-group">
            <label for="hora_pedido">Hora Pedido</label>
            <input type="time" name="hora_pedido" required>
        </div>
        <div class="form-group">
            <label for="loc_destino">Localização Destino</label>
            <input type="text" name="loc_destino" required>
        </div>
        <div class="form-group">
            <label for="loc_partida">Localização Partida</label>
            <input type="text" name="loc_partida" required>
        </div>

        <button type="submit">Salvar Pedido</button>

    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cadastro_idcadastro = $_POST["cadastro_idcadastro"];
        $nome_pedido = $_POST["nome_pedido"];
        $data_pedido = $_POST["data_pedido"];
        $hora_pedido = $_POST["hora_pedido"];
        $loc_destino = $_POST["loc_destino"];
        $loc_partida = $_POST["loc_partida"];

        $server = "localhost";
        $user = "root";
        $password = "";
        $database = "cadastro"; // Usando o banco 'cadastro'
        $port = "3308";

        // Conectar
        $conn = new mysqli($server, $user, $password, $database, $port);

        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // Criar tabela se não existir (Atualizada com novos campos)
        $sql_create = "CREATE TABLE IF NOT EXISTS pedidos (
            idpedidos INT AUTO_INCREMENT PRIMARY KEY,
            cadastro_idcadastro VARCHAR(255),
            nome_pedido VARCHAR(255),
            data_pedido DATE,
            hora_pedido TIME,
            loc_destino VARCHAR(255),
            loc_partida VARCHAR(255)
        )";
        $conn->query($sql_create);

        $sql = "INSERT INTO pedidos (cadastro_idcadastro, nome_pedido, data_pedido, hora_pedido, loc_destino, loc_partida) 
                VALUES ('$cadastro_idcadastro', '$nome_pedido', '$data_pedido', '$hora_pedido', '$loc_destino', '$loc_partida')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Pedido salvo com sucesso!'); window.location.href='pedidos.php';</script>";
        } else {
            echo "<p style='color:red; text-align:center;'>Erro ao salvar pedido: " . $conn->error . "</p>";
        }

        $conn->close();
    }
    ?>
</body>

</html>