<?php
// Simulando uma lista de serviços pendentes de aprovação
$servicos = array(
  array("id" => 1, "titulo" => "Tião, Paulista, 40 anos " , "descricao" => "Responsável pela parte de pintura nos trabalhos que é chamado.
  “Para mim, a pintura é mais do que uma profissão, é uma paixão. ”.
  Pintor profissional
  Busca sempre mais oportunidades no ramo.
  Amor pelo que faz."),
  array("id" => 2, "titulo" =>"Denilson Silva, Baiano, 45 anos" , "descricao" => "Desde cedo era curioso
  e gostava de mexer em eletrônicos. O  vizinho o chamou para trabalhar na loja de  equipamentos de informática.  Formou-se em curso técnico na  adolescência")
);

// Função que aprova ou reprova um serviço
function moderar($id, $acao) {
  // Aqui você pode fazer a lógica para atualizar o status do serviço no banco de dados
  // Por exemplo:
  // $sql = "UPDATE servicos SET status = '$acao' WHERE id = $id";
  // $result = mysqli_query($conn, $sql);
  
  // Retornando uma mensagem de sucesso ou erro
  if ($acao == "aprovar") {
    return "O Prestador $id foi aprovado com sucesso.";
  } elseif ($acao == "reprovar") {
    return "O Prestador $id foi reprovado com sucesso.";
  } else {
    return "Ação inválida.";
  }
}

// Verificando se o usuário clicou em algum botão de moderar
if (isset($_POST['moderar'])) {
  // Pegando o id e a ação do serviço
  $id = $_POST['id'];
  $acao = $_POST['acao'];
  
  // Chamando a função de moderar e mostrando a mensagem de retorno
  echo moderar($id, $acao);
}
?>

<html>
<head>
  <style>
    /* Estilizando a tabela */
    table {
      border-collapse: collapse;
      width: 100%;
    }
    
    th, td {
      background-color: #e6e6e6 ;
      border: 1px solid black;
      padding: 10px;
      text-align: left;
    }
    
    th {
      background-color: #cfcfcf;
    }
    
    /* Estilizando os botões */
    .aprovar {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px;
      cursor: pointer;
    }
    
    .reprovar {
      background-color: #F44336;
      color: white;
      border: none;
      padding: 10px;
      cursor: pointer;
    }
    
  </style>
</head>

<body style="background-color: orange; text-align: center">
<h1>Tela De Aprovação</h1>
<h2>Prestadores Pendentes de Aprovação</h2>
<table>
<tr>
<th>ID</th>
<th>Título</th>
<th>Descrição</th>
<th>Ações</th>
</tr>
<?php
// Percorrendo a lista de serviços e mostrando na tabela
foreach ($servicos as $servico) {
?>
<tr>
<td><?php echo $servico['id']; ?></td>
<td><?php echo $servico['titulo']; ?></td>
<td><?php echo $servico['descricao']; ?></td>
<td>
<!-- Criando um formulário para cada serviço com os botões de aprovar e reprovar -->
<form method="post">
<input type="hidden" name="id" value="<?php echo $servico['id']; ?>">
<input type="hidden" name="moderar" value="true">
<input type="submit" name="acao" value="aprovar" class="aprovar">
<input type="submit" name="acao" value="reprovar" class="reprovar">
</form>
</td>
</tr>
<?php
}
?>
</table>
</body>
</html>