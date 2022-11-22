<?php
  require_once('../cebecalhorodape.php');
  cabecalho(3,1);
  session_start();

?>
    <div id="site_content">
      <div id="content">
      	<div id="body_adapt">
		<body bgcolor="#ECF0F1">
			
	<a href="../consulta.php"><img src="../style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>
             <div style="float:right">
             <form action="imprime_tabela.php" method="post" target="_blank">
	             <input type="image" src="../style/botao-print.png" alt="Submit Form" style="width:80px;height:42px;border:0;cursor:pointer;"/>
             </form>  
          </div>
	<?php 

	include 'database.php';
  include 'escola.php';
    
  $id_emprestimo = $_POST["numeroEmprestimo"];
  $id_escola = $id_escola_atual;
  $string_tabela = "";
  $cabecalho_tabela = "Consulta Emprestimo";

  $query = "SELECT id_aluno, id_professor, id_livro, multa_paga, UNIX_TIMESTAMP(data_emprestimo) AS dia_emprestimo, UNIX_TIMESTAMP(data_devolucao) AS dia_devolucao, concluido FROM Emprestimo WHERE id_emprestimo = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $id_emprestimo);
  $stmt->execute();
  $result = $stmt->get_result();
	if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $string_tabela .= "
	        	<table>
	        		<thread>
					<tr>
						<th width='80'>Emprestimo</th>
            <th>Aluno</th>
            <th>Professor</th>
            <th>Livro</th>
            <th>Multa Paga</th>
            <th>Data Emprestimo</th>
						<th>Data Devolução</th>
						<th>Concluido</th>
					</tr>
					</thread>
        ";
        if ($row["concluido"] == 0)
          $concluido = "NAO";
        else
          $concluido = "SIM";

        $string_tabela .= " <tr>";
          $string_tabela .= "<td>" . $id_emprestimo . "</td>";
					$string_tabela .= "<td>" .$row["id_aluno"] . "</td>";
					$string_tabela .= "<td>" .$row["id_professor"] . "</td>";
					$string_tabela .= "<td>" .$row["id_livro"] . "</td>";
          $string_tabela .= "<td>" .$row["multa_paga"] ."</td>";
          $string_tabela .= "<td>" . date("d/m/Y",$row["dia_emprestimo"]) . "</td>";
          $string_tabela .= "<td>" . date("d/m/Y",$row["dia_devolucao"]) . "</td>";
          $string_tabela .= "<td>" .$concluido . "</td>";
				$string_tabela .= "</tr></table>";
  }
  else{
    $string_tabela .= "<p>0 resultados</p>";
  }
	echo $string_tabela;
	
	$_SESSION["cabecalho"] = $cabecalho_tabela;
  $_SESSION["tabela"] = $string_tabela;
	?>
			
			</div>
		</div>
    </div>
<?php
  rodape();
?>
