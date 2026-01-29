<!-- INÍCIO DO HTML -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Cadastro</title>
    <style>
        /* Estilização da página de exclusão (Fundo avermelhado no container) */
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #ffffffff;
        }

        .container {
            max-width: 600px;
            margin: 70px auto;
            background-color: #f8aeae;
            /* Cor vermelha clara */
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

        .btn-excluir {
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
        }

        select {
            padding: 10px;
            width: 80%;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <!-- BARRA DE NAVEGAÇÃO -->
    <!-- BARRA DE NAVEGAÇÃO -->
    <div class="navbar">
        <a href="primeira_2026.php" class="btn-incluir">Incluir Pessoa</a>
        <a href="alterar.php" class="btn-alterar">Alterar Pessoa</a>
        <a href="excluir.php" class="btn-excluir">Excluir Pessoa</a>
        <a href="pedidos.php" class="btn-incluir">Novo Pedido</a>
        <a href="consulta.php" class="btn-consulta">Listar Pedidos</a>
    </div>

    <?php
    // CONEXÃO COM O BANCO
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "cadastro";
    $port = "3308";
    $conn = new mysqli($server, $user, $password, $database, $port);

    // PROCESSAR EXCLUSÃO (Quando o formulário é enviado)
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        $id_del = $_POST['id'];
        if (!empty($id_del)) {
            // Executa o comando DELETE no banco
            $sql_delete = "DELETE FROM cadastro WHERE idcadastro = $id_del";
            if ($conn->query($sql_delete) === TRUE) {
                echo "<h2>Excluído com Sucesso!</h2>";
                $conn->close();
                exit; // Encerra a execução para não mostrar o formulário novamente
            } else {
                echo "<p style='color:red;'>Erro ao excluir: " . $conn->error . "</p>";
            }
        }
    }

    // BUSCAR DADOS PARA O SELECT (Listar todos os cadastros disponíveis)
    $sql_list = "SELECT idcadastro, nome_cadastro, cpf FROM cadastro";
    $result = $conn->query($sql_list);
    ?>

    <div class="container">
        <h1>Excluir Cadastro</h1>
        <p>Selecione a pessoa que deseja excluir definitivamente:</p>

        <!-- Formulário para selecionar quem excluir -->
        <form method="POST">
            <select name="id" required>
                <option value="">-- Selecione uma pessoa --</option>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Se foi passado ID via GET (ex: vindo de outra página), já deixa selecionado
                        $selected = (isset($_GET['id']) && $_GET['id'] == $row['idcadastro']) ? "selected" : "";
                        echo "<option value='" . $row['idcadastro'] . "' $selected>" . $row['nome_cadastro'] . " (CPF: " . $row['cpf'] . ")</option>";
                    }
                } else {
                    echo "<option value=''>Nenhum cadastro encontrado</option>";
                }
                ?>
            </select>
            <br>
            <button type="submit" class="btn-excluir">Excluir Selecionado</button>
        </form>
    </div>

</body>

</html>