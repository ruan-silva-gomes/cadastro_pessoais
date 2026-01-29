<!-- INÍCIO DO HTML -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Alterar Cadastro</title>
    <style>
        /* Estilos CSS da Página */
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
            background-color: #2196F3;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 10px;
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
    // CONFIGURAÇÃO DA CONEXÃO COM O BANCO DE DADOS
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "cadastro";
    $port = "3308";
    $conn = new mysqli($server, $user, $password, $database, $port);

    // Inicialização de variáveis
    $id = "";
    $row = [];

    // SELECIONAR CADASTRO PELO ID (Método GET)
    // Quando o usuário seleciona alguém no <select>, a página recarrega com ?id=X
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM cadastro WHERE idcadastro = $id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); // Preenche $row com os dados encontrados
        }
    }

    // Se nenhum cadastro foi encontrado ou selecionado, inicializa array vazio para evitar erros no formulário
    if (empty($row)) {
        $row = array_fill_keys(['nome_cadastro', 'cpf', 'rg_cadastro', 'data_nascimento', 'sexo_genero', 'nacionalidade', 'nome_mae', 'nome_pai', 'email', 'celular', 'telefone_fixo', 'cep', 'cidade', 'endereco', 'data_inclusao'], '');
    }

    // LISTAR TODOS OS CADASTROS PARA O MENU DE SELEÇÃO
    $sql_lista = "SELECT idcadastro, nome_cadastro, cpf FROM cadastro";
    $result_lista = $conn->query($sql_lista);
    ?>

    <div class="container">
        <h1>Alterar Cadastro</h1>

        <!-- Formulário para escolher quem editar -->
        <form method="GET" action="alterar.php">
            <select name="id" onchange="this.form.submit()">
                <option value="">-- Selecione uma pessoa --</option>
                <?php
                // Preenche o <select> com os usuários do banco
                if ($result_lista->num_rows > 0) {
                    while ($user = $result_lista->fetch_assoc()) {
                        // Marca como selecionado se o ID bater com o GET atual
                        $selected = ($user['idcadastro'] == $id) ? "selected" : "";
                        echo "<option value='" . $user['idcadastro'] . "' $selected>" . $user['nome_cadastro'] . " (CPF: " . $user['cpf'] . ")</option>";
                    }
                }
                ?>
            </select>
            <br><br>
            <noscript><button type="submit">Selecionar</button></noscript>
        </form>

        <!-- Formulário de Edição (Preenchido com os dados de $row) -->
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group"><label>Nome:</label><br><input type="text" name="nome_cadastro" value="<?php echo $row['nome_cadastro']; ?>" required></div>
            <div class="form-group"><label>CPF:</label><br><input type="text" name="cpf" value="<?php echo $row['cpf']; ?>" required></div>
            <div class="form-group"><label>RG:</label><br><input type="text" name="rg_cadastro" value="<?php echo $row['rg_cadastro']; ?>"></div>
            <div class="form-group"><label>Nascimento:</label><br><input type="date" name="data_nascimento" value="<?php echo $row['data_nascimento']; ?>" required></div>
            <div class="form-group">
                <label>Sexo:</label><br>
                <select name="sexo_genero">
                    <option value="M" <?php if ($row['sexo_genero'] == 'M') echo 'selected'; ?>>Masculino</option>
                    <option value="F" <?php if ($row['sexo_genero'] == 'F') echo 'selected'; ?>>Feminino</option>
                </select>
            </div>
            <!-- Outros campos... -->
            <div class="form-group"><label>Nacionalidade:</label><br><input type="text" name="nacionalidade" value="<?php echo $row['nacionalidade']; ?>"></div>
            <div class="form-group"><label>Mãe:</label><br><input type="text" name="nome_mae" value="<?php echo $row['nome_mae']; ?>"></div>
            <div class="form-group"><label>Pai:</label><br><input type="text" name="nome_pai" value="<?php echo $row['nome_pai']; ?>"></div>
            <div class="form-group"><label>E-mail:</label><br><input type="email" name="email" value="<?php echo $row['email']; ?>" required></div>
            <div class="form-group"><label>Celular:</label><br><input type="tel" name="celular" value="<?php echo $row['celular']; ?>"></div>
            <div class="form-group"><label>Fixo:</label><br><input type="tel" name="telefone_fixo" value="<?php echo $row['telefone_fixo']; ?>"></div>
            <div class="form-group"><label>CEP:</label><br><input type="text" name="cep" value="<?php echo $row['cep']; ?>"></div>
            <div class="form-group"><label>Cidade:</label><br><input type="text" name="cidade" value="<?php echo $row['cidade']; ?>"></div>
            <div class="form-group"><label>Endereço:</label><br><input type="text" name="endereco" value="<?php echo $row['endereco']; ?>"></div>
            <div class="form-group"><label>Data Inclusão:</label><br><input type="date" name="data_inclusao" value="<?php echo $row['data_inclusao']; ?>"></div>

            <button type="submit" name="acao" value="alterar">Salvar Alteração</button>
        </form>
    </div>

    <?php
    // PROCESSAR ALTERAÇÃO (Método POST)
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['acao']) && $_POST['acao'] == 'alterar') {
        // Coleta dados dos inputs
        $id = $_POST['id'];
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

        // Query UPDATE para atualizar todos os campos
        $sql_update = "UPDATE cadastro SET 
                nome_cadastro='$nome', cpf='$cpf', rg_cadastro='$rg', data_nascimento='$nasc', sexo_genero='$sexo', 
                nacionalidade='$nac', nome_mae='$mae', nome_pai='$pai', email='$email', celular='$cel', 
                telefone_fixo='$fixo', cep='$cep', cidade='$cid', endereco='$end', data_inclusao='$data'
                WHERE idcadastro=$id";

        // Executar e dar feedback
        if ($conn->query($sql_update) === TRUE) {
            echo "<p style='color:blue;'>Alterado com sucesso! <a href='consulta.php'>Voltar</a></p>";
        } else {
            echo "<p style='color:red;'>Erro: " . $conn->error . "</p>";
        }
    }
    $conn->close();
    ?>
</body>

</html>