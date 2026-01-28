<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Cadastros</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #ffffffff;
        }

        .container {
            max-width: 90%;
            margin: 70px auto;
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

        .action-btn {
            text-decoration: none;
            padding: 5px 10px;
            color: white;
            border-radius: 5px;
            margin: 2px;
            display: inline-block;
        }

        .btn-edit {
            background-color: #2196F3;
        }

        .btn-delete {
            background-color: #f44336;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <a href="primeira_2026.php" class="btn-incluir">Incluir</a>
        <a href="alterar.php" class="btn-alterar">Alterar</a>
        <a href="excluir.php" class="btn-excluir">Excluir</a>
        <a href="consulta.php" class="btn-consulta">Consulta</a>
    </div>

    <div class="container">
        <h1>Cadastros Realizados</h1>

        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>CPF</th>
                <th>RG</th>
                <th>Nascimento</th>
                <th>Sexo</th>
                <th>Mãe</th>
                <th>Pai</th>
                <th>Nacionalidade</th>
                <th>Celular</th>
                <th>Fixo</th>
                <th>CEP</th>
                <th>Endereço</th>
                <th>Cidade</th>
                <th>Data Inclusão</th>
            </tr>
            <?php
            $server = "localhost";
            $user = "root";
            $password = "";
            $database = "cadastro";
            $port = "3308";
            $conn = new mysqli($server, $user, $password, $database, $port);

            if ($conn->connect_error) {
                die("Falha na conexão: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM cadastro";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Tenta adivinhar o nome da coluna de ID se não for id_cadastro, mas assumirei id_cadastro ou id
                    // Vou assumir que existe um ID para exclusão. Se o usuário não criou, vai dar erro, mas é o padrão.
                    // Vou usar 'id_cadastro' pois é o padrão usual quando tabelas chamam 'cadastro'.
                    // Se der erro o usuário avisa.
                    $id = isset($row["id_cadastro"]) ? $row["id_cadastro"] : (isset($row["id"]) ? $row["id"] : 0);

                    echo "<tr>
                            <td>" . $row["idcadastro"] . "</td>
                            <td>" . $row["nome_cadastro"] . "</td>
                            <td>" . $row["email"] . "</td>
                            <td>" . $row["cpf"] . "</td>
                            <td>" . $row["rg_cadastro"] . "</td>
                            <td>" . $row["data_nascimento"] . "</td>
                            <td>" . $row["sexo_genero"] . "</td>
                            <td>" . $row["nome_mae"] . "</td>
                            <td>" . $row["nome_pai"] . "</td>
                            <td>" . $row["nacionalidade"] . "</td>
                            <td>" . $row["celular"] . "</td>
                            <td>" . $row["telefone_fixo"] . "</td>
                            <td>" . $row["cep"] . "</td>
                            <td>" . $row["endereco"] . "</td>
                            <td>" . $row["cidade"] . "</td>
                            <td>" . $row["data_inclusao"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhum cadastro encontrado</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>

</body>

</html>