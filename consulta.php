<!-- INICIO DO HTML -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- Configurações e estilos da página -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Cadastros</title>
    <style>
        /* Estilos gerais da página */
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #ffffffff;
        }

        /* Container principal */
        .container {
            max-width: 90%;
            margin: 70px auto;
            background-color: #9dd496ff;
            padding: 20px;
            border-radius: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Barra de navegação */
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

        /* Cores dos botões */
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

        /* Estilização da tabela */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <!-- BARRA DE NAVEGAÇÃO para acessar outras áreas do sistema -->
    <!-- BARRA DE NAVEGAÇÃO para acessar outras áreas do sistema -->
    <div class="navbar">
        <a href="primeira_2026.php" class="btn-incluir">Incluir Pessoa</a>
        <a href="alterar.php" class="btn-alterar">Alterar Pessoa</a>
        <a href="excluir.php" class="btn-excluir">Excluir Pessoa</a>
        <a href="pedidos.php" class="btn-incluir">Novo Pedido</a>
        <a href="consulta.php" class="btn-consulta">Listar Pedidos</a>
    </div>

    <!-- ÁREA DE EXIBIÇÃO: Tabela com resultados da consulta -->
    <div class="container">
        <h1>Pedidos</h1>
        <table>
            <!-- Cabeçalho da tabela -->
            <tr>
                <th>Cliente</th>
                <th>Nome Pedido</th>
                <th>Data Pedido</th>
                <th>Hora Pedido</th>
                <th>Localização Destino</th>
                <th>Localização Partida</th>
            </tr>

            <?php
            // Conexão com o banco de dados
            $server = "localhost";
            $user = "root";
            $password = "";
            $database = "cadastro";
            $port = "3308";
            $conn = new mysqli($server, $user, $password, $database, $port);

            // Verifica se houve erro na conexão
            if ($conn->connect_error) {
                die("Falha na conexão: " . $conn->connect_error);
            }

            // EXECUTAR CONSULTA: Seleciona todos os registros da tabela pedidos fazendo JOIN com cadastro
            $sql = "SELECT pedidos.*, cadastro.nome_cadastro 
                    FROM pedidos 
                    LEFT JOIN cadastro ON pedidos.cadastro_idcadastro = cadastro.idcadastro";
            $result = $conn->query($sql);

            // Verifica se há resultados e os exibe linha por linha
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["nome_cadastro"] . "</td>
                            <td>" . $row["nome_pedido"] . "</td>
                            <td>" . $row["data_pedido"] . "</td>
                            <td>" . $row["hora_pedido"] . "</td>
                            <td>" . $row["loc_destino"] . "</td>
                            <td>" . $row["loc_partida"] . "</td>
                        </tr>";
                }
            } else {
                // Caso não haja registros
                echo "<tr><td colspan='8'>Nenhum pedido encontrado</td></tr>";
            }
            // Fecha a conexão com o banco
            $conn->close();
            ?>
        </table>
    </div>

</body>

</html>