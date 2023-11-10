<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Resultados da busca</title>
</head>
<body>
	<?php

	// Dados de conexão
	$host = 'db4free.net';
	$port = '3306';
	$dbname = 'trampo10';
	$username = 'trampo10';
	$password = 'senacgrupo20';

	// Cria conexão com o servidor de banco de dados
	$conn = new mysqli($host, $username, $password, $dbname, $port);

	// Verifica se houve erro na conexão
	if ($conn->connect_error) {
		die("Erro na conexão com o servidor de banco de dados: " . $conn->connect_error);
	}

	// Verifica se o formulário foi enviado
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Obtém o serviço selecionado
		$servico = $_POST["servico"];

		// Consulta o banco de dados para obter os profissionais de serviços com o serviço selecionado
		$sql = "SELECT * FROM prestadores_de_servico WHERE servico = '$servico'";
		$result = $conn->query($sql);

		// Exibe os resultados da consulta
		if ($result->num_rows > 0) {
			echo "<table>
					<tr>
						<th>ID</th>
						<th>Nome</th>
						<th>Serviço</th>
						<th>Endereço</th>
						<th>Telefone</th>
						<th>Email</th>
					</tr>";
			while ($row = $result->fetch_assoc()) {
				echo "<tr>
						<td>".$row["id"]."</td>
						<td>".$row["nome"]."</td>
						<td>".$row["servico"]."</td>
						<td>".$row["endereco"]."</td>
						<td>".$row["telefone"]."</td>
						<td>".$row["email"]."</td>
           
					    </tr>";
			}
			echo "</table>";
		} else {
			echo "Nenhum profissional de serviço encontrado para o serviço selecionado.";
		}

		// Libera o resultado e fecha a conexão com o banco de dados
		$result->free();
		$conn->close();
	}

	?>
</body>
</html>
