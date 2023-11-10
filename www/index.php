<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body style="background-color: orange; text-align: center">
    
  <h1>Seja bem vindo ao Trampo10!</h1>
    <h3>Login</h3>
    <?php
    

    // Dados de conexão com o banco de dados
    $host = 'db4free.net';
    $port = '3306';
    $dbname = 'trampo10';
    $username = 'trampo10';
    $password = 'senacgrupo20';

    // Cria a conexão com o banco de dados
    $conn = new mysqli($host, $username, $password, $dbname, $port);

    // Verifica se a conexão foi bem-sucedida
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recupera os dados do formulário
        $email = $_POST['email'];
        $senha = $_POST['senha'];

         // Verifica se o email inserido é um CPF
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Consulta na tabela 'moderador' se o email é um CPF
        $sql_moderador = "SELECT * FROM moderador WHERE email='$email' AND senha='$senha'";
        $result_moderador = $conn->query($sql_moderador);

        if ($result_moderador->num_rows > 0) {
            // CPF encontrado na tabela 'moderador', redireciona para moderador.php
            $_SESSION['email'] = $email;
            echo "<script>window.location.replace('pages/moderador.php');</script>";
            exit();
        }
    }

    // Se não for um CPF ou não for encontrado na tabela 'moderador', verifica na tabela 'clientes'
    $sql_clientes = "SELECT * FROM clientes WHERE email='$email' AND senha='$senha'";
    $result_clientes = $conn->query($sql_clientes);

    if ($result_clientes->num_rows > 0) {
        // Usuário encontrado, redireciona para a página principal
        $_SESSION['email'] = $email;
        echo "<script>window.location.replace('pages/busca_prestador.php');</script>";
        exit();
    } else {
        // Usuário não encontrado, exibe mensagem de erro
        $mensagem_erro = "Email ou senha inválidos.";
    }
}


    // Fecha a conexão com o banco de dados
    $conn->close();
    ?>

    <?php
    if (isset($mensagem_erro)) {
        // Exibe a mensagem de erro, caso exista
        echo "<p>$mensagem_erro</p>";
    }
    ?>

    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" required><br><br>
        <input type="submit" value="Entrar">
    </form>
 <br>
    <button onclick="redirecionarParaCadastro()">Cadastro</button>

    <script>
        function redirecionarParaCadastro() {
            window.location.href = "pages/cadastrogeral.php";
        }
    </script>
    


</body>
</html>
