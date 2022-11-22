<?php
  require_once('../cebecalhorodape.php');
  cabecalho(5,1);
?>
    <div id="site_content">
      <div id="content">
      	<div id="body_adapt">
		<body bgcolor="#ECF0F1">
			
	<a href="../relatorio.php"><img src="../style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>
             <div style="float:right">
             <form action="imprime_tabela.php" method="post" target="_blank">
	             <input type="image" src="../style/botao-print.png" alt="Submit Form" style="width:80px;height:42px;border:0;cursor:pointer;"/>
             </form>  
          </div>
	<?php 


			$string_tabela = "";
			$cabecalho_tabela = "";
			include 'database.php';
			include 'escola.php';
			session_start();
			
		

		switch ($_GET["id"]) {
			case 1: //Livros mais emprestados
				$input_date_inicial = $_POST["dataInicial"];
				$data_inicial =date("Y-m-d H:i:s",strtotime($input_date_inicial));

				$input_date_final = $_POST["dataFinal"];
				$data_final =date("Y-m-d H:i:s",strtotime($input_date_final));
				$id_escola = $_POST["Escola"];
				$cabecalho_tabela .= "Relatório: Livros mais emprestados - Escola ".$id_escola." - Data: ". date("d/m/y", strtotime($input_date_inicial))." até ".date("d/m/y", strtotime($input_date_final));
				$query = "SELECT Livro.titulo, COUNT(Emprestimo.id_emprestimo) AS Quantidade, Livro.autor FROM Livro JOIN Emprestimo ON Livro.id_livro = Emprestimo.id_livro WHERE Livro.id_escola = '$id_escola' AND DATEDIFF('$data_inicial', Emprestimo.data_emprestimo) < 0 AND DATEDIFF('$data_final', Emprestimo.data_emprestimo) > -1 GROUP BY Livro.id_livro ORDER BY Quantidade DESC LIMIT 50;";

				$result = $conn->query($query);
				if ($result->num_rows > 0) 
				{
					$string_tabela .= "
		        	<thread>
		        	<table>				
		        		<tr>
							<th>Titulo</th>
							<th>Autor</th>
							<th>Quantidade</th>
							
						</tr>
					</thread>
					<tbody>
					";
					while($row = $result->fetch_assoc())
					{
						$string_tabela .= " <tbody> <tr>";
							$string_tabela .= "<td>" .$row["titulo"] . "</td>";
							$string_tabela .= "<td>" .$row["autor"] . "</td>";
							$string_tabela .= "<td>" .$row["Quantidade"] . "</td>";
						$string_tabela .= "</tr>";
						
					}

					$string_tabela .= "</tbody></table>";
				}
				else
				{
					$string_tabela .= "<br><p>0 resultados.</p>";
				}
				break;

				case 2: //Alunos que mais emprestaram
					$input_date_inicial = $_POST["dataInicial"];
					$data_inicial =date("Y-m-d H:i:s",strtotime($input_date_inicial));

					$input_date_final = $_POST["dataFinal"];
					$data_final =date("Y-m-d H:i:s",strtotime($input_date_final));
					$id_escola = $_POST["Escola"];
					$cabecalho_tabela .= "Relatório: Alunos que mais emprestaram - Escola ".$id_escola." - Data: ". date("d/m/y", strtotime($input_date_inicial))." até ".date("d/m/y", strtotime($input_date_final));
					$query = "SELECT Aluno.nome, COUNT(Emprestimo.id_emprestimo) AS Quantidade, Aluno.id_aluno FROM Aluno JOIN Emprestimo ON Aluno.id_aluno = Emprestimo.id_aluno WHERE Aluno.id_escola = '$id_escola' AND DATEDIFF('$data_inicial', Emprestimo.data_emprestimo) < 0 AND DATEDIFF('$data_final', Emprestimo.data_emprestimo) > -1 GROUP BY Aluno.id_aluno ORDER BY Quantidade DESC LIMIT 50;";

					$result = $conn->query($query);
					if ($result->num_rows > 0) 
					{
						$string_tabela .= "
			        	<thread>
			        	<table>				
			        		<tr>
								<th>ID Aluno</th>
								<th>Nome</th>
								<th>Quantidade</th>
								
							</tr>
						</thread>
						<tbody>
						";
						while($row = $result->fetch_assoc())
						{
							$string_tabela .= " <tbody> <tr>";
								$string_tabela .= "<td>" .$row["id_aluno"] . "</td>";
								$string_tabela .= "<td>" .$row["nome"] . "</td>";
								$string_tabela .= "<td>" .$row["Quantidade"] . "</td>";
							$string_tabela .= "</tr>";
							
						}

						$string_tabela .= "</tbody></table>";
					}
					else
					{
						$string_tabela .= "<br><p>0 resultados.</p>";
					}
					break;

				case 3: //Generos mais emprestados
					$input_date_inicial = $_POST["dataInicial"];
					$data_inicial =date("Y-m-d H:i:s",strtotime($input_date_inicial));

					$input_date_final = $_POST["dataFinal"];
					$data_final =date("Y-m-d H:i:s",strtotime($input_date_final));
					$id_escola = $_POST["Escola"];
					$cabecalho_tabela .= "Relatório: Generos mais emprestados - Escola ".$id_escola." - Data: ". date("d/m/y", strtotime($input_date_inicial))." até ".date("d/m/y", strtotime($input_date_final));
					$query = "SELECT Livro.area_conhecimento, COUNT(Emprestimo.id_emprestimo) AS Quantidade FROM Livro JOIN Emprestimo ON Livro.id_livro = Emprestimo.id_livro WHERE Livro.id_escola = '$id_escola' AND DATEDIFF('$data_inicial', Emprestimo.data_emprestimo) < 0 AND DATEDIFF('$data_final', Emprestimo.data_emprestimo) > -1 GROUP BY Livro.area_conhecimento ORDER BY Quantidade DESC LIMIT 50;";

					$result = $conn->query($query);
					if ($result->num_rows > 0) 
					{
						$string_tabela .= "
			        	<thread>
			        	<table>				
			        		<tr>
								<th>Area do Conhecimento</th>
								<th>Quantidade</th>
								
							</tr>
						</thread>
						<tbody>
						";
						while($row = $result->fetch_assoc())
						{
							$string_tabela .= " <tbody> <tr>";
								$string_tabela .= "<td>" .$row["area_conhecimento"] . "</td>";
								$string_tabela .= "<td>" .$row["Quantidade"] . "</td>";
							$string_tabela .= "</tr>";
							
						}

						$string_tabela .= "</tbody></table>";
					}
					else
					{
						$string_tabela .= "<br><p>0 resultados.</p>";
					}
					break;

				case 4: //Livros para devolucao

					if (isset($_GET["case"])){
						$cabecalho_tabela .= "Relatório: Livros para devolucao - Escola ".$id_escola_atual." - Todos Empréstimos Ativos de Professores";
						$query = "SELECT Livro.titulo, DAY(Emprestimo.data_emprestimo) as Dia, MONTH(Emprestimo.data_emprestimo) as Mes, YEAR(Emprestimo.data_emprestimo) as Ano, Livro.id_livro, Professor.nome FROM Livro JOIN Emprestimo ON Livro.id_livro = Emprestimo.id_livro JOIN Professor ON Emprestimo.id_professor = Professor.id_professor WHERE Livro.id_escola = '$id_escola_atual' AND Emprestimo.concluido = 0 ORDER BY Emprestimo.data_devolucao ASC;";
					}
					else{
						$input_date_inicial = $_POST["dataInicial"];
						$data_inicial =date("Y-m-d H:i:s",strtotime($input_date_inicial));

						$input_date_final = $_POST["dataFinal"];
						$data_final =date("Y-m-d H:i:s",strtotime($input_date_final));
						$id_escola = $_POST["Escola"];
						$cabecalho_tabela .= "Relatório: Livros para devolucao - Escola ".$id_escola." - Data: ". date("d/m/y", strtotime($input_date_inicial))." até ".date("d/m/y", strtotime($input_date_final));
						$query = "SELECT Livro.titulo, DAY(Emprestimo.data_devolucao) as Dia, MONTH(Emprestimo.data_devolucao) as Mes, YEAR(Emprestimo.data_devolucao) as Ano, Livro.id_livro, Aluno.nome FROM Livro JOIN Emprestimo ON Livro.id_livro = Emprestimo.id_livro JOIN Aluno ON Emprestimo.id_aluno = Aluno.id_aluno WHERE Livro.id_escola = '$id_escola' AND DATEDIFF('$data_inicial', Emprestimo.data_devolucao) <= 0 AND DATEDIFF('$data_final', Emprestimo.data_devolucao) >= 0 AND Emprestimo.concluido = 0 ORDER BY Emprestimo.data_devolucao ASC;";
					}
					$result = $conn->query($query);
					if ($result->num_rows > 0) 
					{
						$string_tabela .= "
			        	<thread>
			        	<table>				
			        		<tr>
								<th>ID Livro</th>";
								if(isset($_GET["case"])) //Emprestimo para professor
									$string_tabela .= "<th>Professor</th>";
								else //Emprestimo para aluno
								$string_tabela .= "<th>Aluno</th>";
								$string_tabela .= "<th>Titulo</th>";
								if(isset($_GET["case"])) //Emprestimo para professor
									$string_tabela .= "<th>Data Empréstimo</th>";
								else //Emprestimo para aluno
								$string_tabela .= "<th>Data Devolucao</th>";
							$string_tabela .= "</tr>
						</thread>
						<tbody>
						";
						while($row = $result->fetch_assoc())
						{
							$string_tabela .= "  <tr>";
								$string_tabela .= "<td>" .$row["id_livro"] . "</td>";
								$string_tabela .= "<td>" .$row["nome"] . "</td>";
								$string_tabela .= "<td>" .$row["titulo"] . "</td>";
								$string_tabela .= "<td>" .$row["Dia"] . "/" . $row["Mes"] . "/" . $row["Ano"] . "</td>";
							$string_tabela .= "</tr>";
							
						}

						$string_tabela .= "</table>";
					}
					else
					{
						$string_tabela .= "<br><p>0 resultados.</p>";
					}
					break;
				case 5: //Total multa arrecadadas
					$input_date_inicial = $_POST["dataInicial"];
					$data_inicial =date("Y-m-d H:i:s",strtotime($input_date_inicial));

					$input_date_final = $_POST["dataFinal"];
					$data_final =date("Y-m-d H:i:s",strtotime($input_date_final));
					$id_escola = $_POST["Escola"];
					$cabecalho_tabela .= "Relatório: Total de multas arrecadadas - Escola ".$id_escola." - Data: ". date("d/m/y", strtotime($input_date_inicial))." até ".date("d/m/y", strtotime($input_date_final));
					$query = "SELECT SUM(multa_paga) as valor FROM Emprestimo WHERE id_escola = '$id_escola' AND DATEDIFF('$data_inicial', Emprestimo.data_emprestimo) <= 0 AND DATEDIFF('$data_final', Emprestimo.data_emprestimo) >= 0 AND concluido = 1";

					$result = $conn->query($query);
					if ($result->num_rows > 0) 
					{
						$row = $result->fetch_assoc();
						$string_tabela .= '<script type="text/javascript">
          				 window.location = "/projeto2/action/action-retornamulta?valor= ' . $row["valor"] . '"
      					</script>';
					}
					else
					{
						$string_tabela .= "<br>0 resultados.";
					}
					break;
				case 6:
				$cabecalho_tabela .= "Escolas Municipais de Toledo";
					$query = "SELECT nome, id_escola, telefone FROM Escola;";

					$result = $conn->query($query);
					if ($result->num_rows > 0) 
					{
						$string_tabela .= "
			        	<thread>
			        	<table>				
			        		<tr>
								<th>ID</th>
								<th>Nome</th>
								<th>Telefone</th>
								
							</tr>
						</thread>
						<tbody>
						";
						while($row = $result->fetch_assoc())
						{
							$string_tabela .= "  <tr>";
								$string_tabela .= "<td>" .$row["id_escola"] . "</td>";
								$string_tabela .= "<td>" .$row["nome"] . "</td>";
								$string_tabela .= "<td>" .$row["telefone"] . "</td>";
							$string_tabela .= "</tr>";
							
						}

						$string_tabela .= "</table>";
					}
					
					else
					{
						$string_tabela .= "<br><p>0 resultados.</p>";
					}
				break;
				
				case 7: //Total de multas a receber
					$cabecalho_tabela .= "Total de multas a receber";
					$query = "SELECT SUM(multa_devendo) AS multa , Aluno.nome as nome, Aluno.id_aluno as id FROM Emprestimo JOIN Aluno ON Emprestimo.id_aluno = Aluno.id_aluno GROUP BY Aluno.id_aluno HAVING multa > 0;";

					$result = $conn->query($query);
					if ($result->num_rows > 0) 
					{
						$string_tabela .= "
			        	<thread>
			        	<table>				
			        		<tr>
								<th>ID</th>
								<th>Nome</th>
								<th>Multa</th>
								
							</tr>
						</thread>
						<tbody>
						";
						while($row = $result->fetch_assoc())
						{
							$string_tabela .= "  <tr>";
								$string_tabela .= "<td>" .$row["id"] . "</td>";
								$string_tabela .= "<td>" .$row["nome"] . "</td>";
								$string_tabela .= "<td>" .$row["multa"] . "</td>";
							$string_tabela .= "</tr>";
							
						}

						$string_tabela .= "</table>";
					}
					
					else
					{
						$string_tabela .= "<br><p>0 resultados.</p>";
					}
				break;
			default:
				
				break;
		}


	echo $string_tabela;
	
    $_SESSION["tabela"] = $string_tabela;
	$_SESSION["cabecalho"] = $cabecalho_tabela;
    print "\r\n";
	?>
	
			</div>
		</div>
    </div>
<?php
  rodape();
?>
