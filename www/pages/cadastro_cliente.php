<!DOCTYPE html>
<html>
<head>
	<title>Cadastro de Cliente</title>
</head>
<body style="background-color: orange; text-align: center">
	<h1>Cadastro de Cliente</h1>
	<form method="post" action="">
		<label for="nome">Nome:</label>
		<input type="text" name="nome" id="nome" required><br><br>
		
		<label for="email">E-mail:</label>
		<input type="email" name="email" id="email" required><br><br>
		
		<label for="telefone">Telefone:</label>
		<input type="tel" name="telefone" id="telefone" required><br><br>
		
		<label for="endereco">Endereço:</label>
		<input type="text" name="endereco" id="endereco" required><br><br>

    <label for="senha">Senha:</label>
		<input type="text" name="senha" id="senha" required><br><br>
		
		<input type="submit" value="Cadastrar">
	</form>

  <?php

  $host = 'db4free.net';
	$port = '3306';
	$dbname = 'trampo10';
	$username = 'trampo10';
	$password = 'senacgrupo20';

	// Cria conexão com o servidor de banco de dados
	$conn = new mysqli($host, $username, $password, $dbname, $port);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}
if (isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["telefone"]) && isset($_POST["endereco"]) && isset($_POST["senha"])) {
// Obtém os dados enviados pelo formulário
$nome = isset($_POST["nome"]) ? $_POST["nome"] : '';
$email = isset($_POST["email"]) ? $_POST["email"] : '';
$telefone = isset($_POST["telefone"]) ? $_POST["telefone"] : '';
$endereco = isset($_POST["endereco"]) ? $_POST["endereco"] : '';
$senha = isset($_POST["senha"]) ? $_POST["senha"] : '';

// Prepara e executa a consulta SQL para inserir os dados no banco de dados
$sql = "INSERT INTO clientes (nome, email, telefone, endereco, senha) VALUES ('$nome', '$email', '$telefone', '$endereco', '$senha')";
if ($conn->query($sql) === TRUE) {
	echo "Cadastro de cliente realizado com sucesso!";
	echo "<br><br>";
	echo "<button onclick='window.location.href = \"http://localhost/index.php\";'>Voltar para Home</button>";
	} else {
	echo "Erro ao cadastrar cliente: " . $conn->error;
	}
}
// Fecha a conexão com o banco de dados
$conn->close();

?>
</body>
</html>