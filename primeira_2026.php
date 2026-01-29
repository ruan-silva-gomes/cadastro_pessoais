<!-- INÍCIO DO HTML: Estrutura básica da página -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- Configurações de metadados e título da página -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir Cadastro</title>
    <!-- Estilos CSS para formatar a página -->
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
        }

        input,
        select {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 80%;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 10px;
        }
    </style>
</head>

<body>


    <!-- BARRA DE NAVEGAÇÃO: Links para outras páginas do sistema -->
    <div class="navbar">
        <a href="primeira_2026.php" class="btn-incluir">Incluir Pessoa</a>
        <a href="alterar.php" class="btn-alterar">Alterar Pessoa</a>
        <a href="excluir.php" class="btn-excluir">Excluir Pessoa</a>
        <a href="pedidos.php" class="btn-incluir">Novo Pedido</a>
        <a href="consulta.php" class="btn-consulta">Listar Pedidos</a>
    </div>


    <div class="container">
        <h1>Incluir Novo Cadastro</h1>
        <form method="POST">
            <div class="form-group"><label>Nome:</label><br><input type="text" name="nome_cadastro" required></div>
            <div class="form-group"><label>CPF:</label><br><input type="text" name="cpf" required></div>
            <div class="form-group"><label>RG:</label><br><input type="text" name="rg_cadastro"></div>
            <div class="form-group"><label>Nascimento:</label><br><input type="date" name="data_nascimento" required></div>
            <div class="form-group">
                <label>Sexo:</label><br>
                <select name="sexo_genero">
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select>
            </div>
            <div class="form-group"><label>Nacionalidade:</label><br><input type="text" name="nacionalidade"></div>
            <div class="form-group"><label>Mãe:</label><br><input type="text" name="nome_mae"></div>
            <div class="form-group"><label>Pai:</label><br><input type="text" name="nome_pai"></div>
            <div class="form-group"><label>E-mail:</label><br><input type="email" name="email" required></div>
            <div class="form-group"><label>Celular:</label><br><input type="tel" name="celular"></div>
            <div class="form-group"><label>Fixo:</label><br><input type="tel" name="telefone_fixo"></div>
            <div class="form-group"><label>CEP:</label><br><input type="text" name="cep"></div>
            <div class="form-group"><label>Cidade:</label><br><input type="text" name="cidade"></div>
            <div class="form-group"><label>Endereço:</label><br><input type="text" name="endereco"></div>
            <div class="form-group"><label>Data Inclusão:</label><br><input type="date" name="data_inclusao" value="<?php echo date('Y-m-d'); ?>"></div>

            <button type="submit">Salvar Inclusão</button>
        </form>
    </div>

    <?php
    // LÓGICA PHP: Processa o formulário quando enviado via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Configurações de conexão com o banco de dados
        $server = "localhost";
        $user = "root";
        $password = "";
        $database = "cadastro";
        $port = "3308";

        // Cria a conexão com o banco
        $conn = new mysqli($server, $user, $password, $database, $port);

        // Recebe os dados do formulário
        $nome = $_POST['nome_cadastro'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg_cadastro'];
        $nasc = $_POST['data_nascimento'];
        $sexo = $_POST['sexo_genero'];
        $nac = $_POST['nacionalidade'];
        $mae = $_POST['nome_mae'];
        $pai = $_POST['nome_pai'];
        $email = $_POST['email'];
        $cel = $_POST['celular'];
        $fixo = $_POST['telefone_fixo'];
        $cep = $_POST['cep'];
        $cid = $_POST['cidade'];
        $end = $_POST['endereco'];
        $data = $_POST['data_inclusao'];

        // Prepara a consulta SQL de inserção
        $sql = "INSERT INTO cadastro (nome_cadastro, cpf, rg_cadastro, data_nascimento, sexo_genero, nacionalidade, nome_mae, nome_pai, email, celular, telefone_fixo, cep, cidade, endereco, data_inclusao)
                VALUES ('$nome', '$cpf', '$rg', '$nasc', '$sexo', '$nac', '$mae', '$pai', '$email', '$cel', '$fixo', '$cep', '$cid', '$end', '$data')";

        // Executa a consulta e verifica se houve sucesso
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color:green;'>Cadastrado com sucesso!</p>";
        } else {
            echo "<p style='color:red;'>Erro: " . $conn->error . "</p>";
        }
        // Fecha a conexão
        $conn->close();
    }
    ?>
</body>

</html>