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
		$titulo = (isset($_POST["titulo"]) ? $_POST["titulo"] : NULL);
		$codigo = (isset($_POST["codLivro"]) ? $_POST["codLivro"] : NULL) ;
		$autor = (isset($_POST["autor"]) ? $_POST["autor"] : NULL);
		$assunto = (isset($_POST["areaLivro"]) ? $_POST["areaLivro"] : NULL);
		$ordem = (isset($_POST["ordem"]) ? $_POST["ordem"] : NULL);
		$id_escola = (isset($_POST["Escola"]) ? $_POST["Escola"] : NULL);
		$nome_professor = (isset($_POST["nomeProfessor"]) ? $_POST["nomeProfessor"] : NULL);

		
		
		$string_tabela = "";
		$cabecalho_tabela = "";
		

		if (isset($_GET["id"]))
		{
			switch ($_GET["id"]) {
				case 1: //consulta aluno
					
					if (isset($_POST["nomeAluno"]) && $_POST["nomeAluno"] != '') //pesquisa pelo nome do aluno
					{
						$nome_aluno = $_POST["nomeAluno"];
						$cabecalho_tabela .= "Consulta Aluno - Escola ".$id_escola." - Pesquisa:  ".$nome_aluno;
						$query = "SELECT id_aluno, Aluno.nome as aluno, Escola.nome as escola, DAY(Aluno.aniversario) as dia, MONTH(Aluno.aniversario) as mes, YEAR(Aluno.aniversario) as ano FROM Aluno JOIN Escola ON Aluno.id_escola = Escola.id_escola WHERE MATCH (Aluno.nome) AGAINST (?) AND Aluno.id_escola = ? AND Aluno.ativo = 1;";
						$stmt = $conn->prepare($query);
  						$stmt->bind_param("ss", $nome_aluno, $id_escola);
						
					}
					else //todos alunos da escola
					{	
						$cabecalho_tabela .= "Consulta Aluno - Escola ".$id_escola." - Todos alunos";
						$query = "SELECT id_aluno, Aluno.nome as aluno, Escola.nome as escola, DAY(Aluno.aniversario) as dia, MONTH(Aluno.aniversario) as mes, YEAR(Aluno.aniversario) as ano FROM Aluno JOIN Escola ON Aluno.id_escola = Escola.id_escola WHERE Aluno.id_escola = ? AND Aluno.ativo = 1 ORDER BY Aluno.nome ASC;";
						$stmt = $conn->prepare($query);
 						$stmt->bind_param("s", $id_escola);
					} 
					$stmt->execute();
  					$result = $stmt->get_result();
					#$result = $conn->query($query);
					if ($result->num_rows > 0) 
					{
						
						$string_tabela .= "
			        	<thread>
			        	<table>				
			        		<tr>
								<th width='80'>Código</th>
								<th>Nome</th>
								<th>Data Nascimento</th>
								<th>Escola</th>
								
							</tr>
						</thread>
						<tbody>
						";
						while($row = $result->fetch_assoc())
						{
							$string_tabela .= " <tbody> <tr>";
								$string_tabela .= "<td>" .$row["id_aluno"] . "</td>";
								$string_tabela .= "<td>" .$row["aluno"] . "</td>";
								$string_tabela .= "<td>" .$row["dia"] . "/" . $row["mes"] . "/" . $row["ano"] . "</td>";
								$string_tabela .= "<td>" .$row["escola"] . "</td>";
							$string_tabela .= "</tr>";
							
						}

						$string_tabela .= "</tbody></table>";
					}
					else
					{
						$string_tabela .= '<p id="informacao">0 resultados.</p>';
					}
					break;
				
				case 2: // consulta professor
				if (isset($_POST["nomeProfessor"]) && $_POST["nomeProfessor"] != '') //consuta com nome
				{
					$nomeProfessor = $_POST["nomeProfessor"];
					$cabecalho_tabela .= "Consulta Professor - Escola ".$id_escola." - Pesquisa:  ".$nomeProfessor;
					$query = "SELECT Professor.id_professor, Professor.nome as professor, Escola.nome as escola FROM Professor JOIN Escola ON Professor.id_escola = Escola.id_escola WHERE MATCH(Professor.nome) AGAINST (?) AND Professor.id_escola = ? AND Professor.ativo = 1 ORDER BY Professor.nome ASC";
					$stmt = $conn->prepare($query);
					$stmt->bind_param("ss", $nomeProfessor, $id_escola);
				}
				else //todos os professores
				{
				$cabecalho_tabela .= "Consulta Professor - Escola ".$id_escola." - Todos professores<br>";
				$query = "SELECT Professor.id_professor, Professor.nome as professor, Escola.nome as escola FROM Professor JOIN Escola ON Professor.id_escola = Escola.id_escola WHERE Professor.id_escola = ? AND Professor.ativo = 1 ORDER BY Professor.nome ASC";
				$stmt = $conn->prepare($query);
				$stmt->bind_param("s", $id_escola);
			
				}
				$stmt->execute();
				$result = $stmt->get_result();
				#$result = $conn->query($query);
					if ($result->num_rows > 0) 
					{
						$string_tabela .= "
			        	<thread>
			        	<table>				
			        		<tr>
								<th width='80'>Código</th>
								<th>Nome</th>
								<th>Escola</th>
								
							</tr>
						</thread>
						<tbody>
						";
						while($row = $result->fetch_assoc())
						{
							$string_tabela .= " <tbody> <tr>";
								$string_tabela .= "<td>" .$row["id_professor"] . "</td>";
								$string_tabela .= "<td>" .$row["professor"] . "</td>";
								$string_tabela .= "<td>" .$row["escola"] . "</td>";
							$string_tabela .= "</tr>";
							
						}

						$string_tabela .= "</tbody></table>";
					}
					else
					{
						$string_tabela .= '<p id="informacao">0 resultados.</p>';

					}
					break;
				default:
					break;
			}
		}



		else
		{
			switch ($ordem) {
				case 1:
					$ordem = "titulo";
					break;
				case 2:
					$ordem = "autor";
					break;
				case 3:
					$ordem = "area_conhecimento";
					break;
				case 4:
					$ordem = "id_livro";
					break;
				default:
					$ordem = "id_livro";
					break;
				
			}
			if ($assunto == "NULL")
				$assunto = NULL;
			if ($titulo == NULL)
				$titulo = NULL;
			if ($autor == NULL)
				$autor = NULL;
			if ($codigo == NULL)
				$codigo = NULL;


				if (isset($codigo))
				{
					//query for when there's the ID
					$query = "SELECT id_livro, titulo, sub_titulo, tipo_obra, area_conhecimento, origem, numero_edicao, isbn, serie, ativo, autor, Escola.nome FROM Livro JOIN Escola ON Livro.id_escola = Escola.id_escola where id_livro = ?;";
					$stmt = $conn->prepare($query);
					$stmt->bind_param("s", $codigo);
					$stmt->execute();
					$result = $stmt->get_result();
					#$result = $conn->query($query);
					if ($result->num_rows > 0) 
					{
						//query para obter o id do emprestimo
						$query_id_emprestimo = "SELECT id_emprestimo FROM Emprestimo WHERE id_livro = ? AND concluido = 0";
						$stmt_id_emprestimo = $conn->prepare($query_id_emprestimo);
						$stmt_id_emprestimo->bind_param("s", $codigo);
						$stmt_id_emprestimo->execute();
						$result_id_emprestimo = $stmt_id_emprestimo->get_result();
						#$result_id_emprestimo = $conn->query($query_id_emprestimo);
						if ($result_id_emprestimo->num_rows > 0) {
							while($row_id_emprestimo = $result_id_emprestimo->fetch_assoc()){
								$consulta_id_emprestimo = $row_id_emprestimo["id_emprestimo"];
							}
						}
						else
							$consulta_id_emprestimo = "Disponível";


						$cabecalho_tabela .= "Consulta Livro - Pesquisa por código";
						$string_tabela .= "
						<thread>
						<table>				
							<tr>
								<th width='80'>Código</th>
								<th>Titulo</th>
								<th>Subtítulo</th>
								<th>Tipo da Obra</th>
								<th>Assunto</th>
								<th>Autor</th>
								<th>Origem</th>
								<th>Edição</th>
								<th>ISBN</th>
								<th>Série</th>
								<th>Escola</th>
								<th>ID Emprestimo</th>
								<th>Ativo</th>
							</tr>
						</thread>
						<tbody>
						";
						while($row = $result->fetch_assoc())
						{
								$consulta_id_livro = $row["id_livro"];
								$consulta_titulo = $row["titulo"];
								$consulta_sub_titulo = $row["sub_titulo"];
								$consulta_tipo_obra = $row["tipo_obra"];
								$consulta_area_conhecimento = $row["area_conhecimento"];
								$consulta_autor = $row["autor"];
								$consulta_origem = $row["origem"];
								$consulta_numero_edicao = $row["numero_edicao"];
								$consulta_isbn = $row["isbn"];
								$consulta_serie = $row["serie"];
								$consulta_nome = $row["nome"];
								$consulta_ativo = $row["ativo"];
							
						}



							$string_tabela .= " <tbody> <tr>";
								$string_tabela .= "<td>" .$consulta_id_livro . "</td>";
								$string_tabela .= "<td>" .$consulta_titulo . "</td>";
								$string_tabela .= "<td>" .$consulta_sub_titulo . "</td>";
								$string_tabela .= "<td>" .$consulta_tipo_obra . "</td>";
								$string_tabela .= "<td>" .$consulta_area_conhecimento ."</td>";
								$string_tabela .= "<td>" .$consulta_autor . "</td>";
								$string_tabela .= "<td>" .$consulta_origem . "</td>";
								$string_tabela .= "<td>" .$consulta_numero_edicao . "</td>";
								$string_tabela .= "<td>" .$consulta_isbn . "</td>";
								$string_tabela .= "<td>" .$consulta_serie . "</td>";
								$string_tabela .= "<td>" .$consulta_nome . "</td>";
								$string_tabela .= "<td>" .$consulta_id_emprestimo . "</td>";
								if ($consulta_ativo)
									$string_tabela .= "<td>Ativo</td>";
								else
									$string_tabela .= "<td>Inativo</td>";
							$string_tabela .= "</tr>";
							$string_tabela .= "</tbody></table>";
					}
					else
					{
						$string_tabela .= "0 resultados.";
					}
				}
			/*	
			if (isset($codigo))
			{
				//query for when there's the ID
				$query = "SELECT id_livro, titulo, sub_titulo, tipo_obra, area_conhecimento, origem, numero_edicao, isbn, serie, ativo, autor, Escola.nome FROM Livro JOIN Escola ON Livro.id_escola = Escola.id_escola where id_livro = '$codigo';";
				$result = $conn->query($query);
				if ($result->num_rows > 0) 
				{
					$cabecalho_tabela .= "Consulta Livro - Pesquisa por código";
					$string_tabela .= "
		        	<thread>
		        	<table>				
		        		<tr>
							<th width='80'>Código</th>
							<th>Titulo</th>
							<th>Subtítulo</th>
							<th>Tipo da Obra</th>
							<th>Assunto</th>
							<th>Autor</th>
							<th>Origem</th>
							<th>Número Edição</th>
							<th>ISBN</th>
							<th>Série</th>
							<th>Escola</th>
							<th>Ativo</th>
						</tr>
					</thread>
					<tbody>
					";
					while($row = $result->fetch_assoc())
					{
						$string_tabela .= " <tbody> <tr>";
							$string_tabela .= "<td>" .$row["id_livro"] . "</td>";
							$string_tabela .= "<td>" .$row["titulo"] . "</td>";
							$string_tabela .= "<td>" .$row["sub_titulo"] . "</td>";
							$string_tabela .= "<td>" .$row["tipo_obra"] . "</td>";
							$string_tabela .= "<td>" .$row["area_conhecimento"] ."</td>";
							$string_tabela .= "<td>" .$row["autor"] . "</td>";
							$string_tabela .= "<td>" .$row["origem"] . "</td>";
							$string_tabela .= "<td>" .$row["numero_edicao"] . "</td>";
							$string_tabela .= "<td>" .$row["isbn"] . "</td>";
							$string_tabela .= "<td>" .$row["serie"] . "</td>";
							$string_tabela .= "<td>" .$row["nome"] . "</td>";
							if ($row["ativo"])
								$string_tabela .= "<td>Ativo</td>";
							else
								$string_tabela .= "<td>Inativo</td>";
						$string_tabela .= "</tr>";
						
					}

					$string_tabela .= "</tbody></table>";
				}
				else
				{
					$string_tabela .= "0 resultados.";
				}
			}*/
			
			else { 				//nao foi digitado codigo
			if ($id_escola == "00") //escolhido todas as escolas
			{
				if (isset($titulo) && isset($autor) && isset($assunto))
				{ //TITULO E AUTOR E ASSUNTO
					$cabecalho_tabela .= "Consulta Livro - Todas Escolas - Titulo: ".$titulo." - Autor: ".$autor." - Assunto: ".$assunto;
					$query = "SELECT id_livro, titulo, autor, area_conhecimento FROM Livro WHERE ativo = 1 AND MATCH(titulo, sub_titulo) AGAINST (?) AND MATCH(autor) AGAINST (?) AND area_conhecimento = ? ORDER BY $ordem ASC;";
					$stmt = $conn->prepare($query);
					$stmt->bind_param("sss", $titulo, $autor, $assunto);
				}
				else if (isset($titulo) && isset($autor) && !isset($assunto))
				{
					$cabecalho_tabela .= "Consulta Livro - Todas Escolas - Titulo: ".$titulo." - Autor: ".$autor;
					$query = "SELECT id_livro, titulo, autor, area_conhecimento FROM Livro WHERE ativo = 1 AND MATCH(titulo, sub_titulo) AGAINST (?) AND MATCH(autor) AGAINST (?) ORDER BY $ordem ASC;";
					$stmt = $conn->prepare($query);
					$stmt->bind_param("ss", $titulo, $autor);
				}
				else if (isset($titulo) && !isset($autor) && isset($assunto))
				{
					$cabecalho_tabela .= "Consulta Livro - Todas Escolas - Titulo: ".$titulo." - Assunto: ".$assunto;
					$query = "SELECT id_livro, titulo, autor, area_conhecimento FROM Livro WHERE ativo = 1 AND MATCH(titulo, sub_titulo) AGAINST (?) AND area_conhecimento = ? ORDER BY $ordem ASC;";
					$stmt = $conn->prepare($query);
					$stmt->bind_param("ss", $titulo, $assunto);
				}
				else if (isset($titulo) && !isset($autor) && !isset($assunto))
				{
					$cabecalho_tabela .= "Consulta Livro - Todas Escolas - Titulo: ".$titulo;
					$query = "SELECT id_livro, titulo, autor, area_conhecimento FROM Livro WHERE ativo = 1 AND MATCH(titulo, sub_titulo) AGAINST (?) ORDER BY $ordem ASC;";
					$stmt = $conn->prepare($query);
					$stmt->bind_param("s", $titulo);
				}
				else if (!isset($titulo) && isset($autor) && isset($assunto))
				{
					$cabecalho_tabela .= "Consulta Livro - Todas Escolas - Autor: ".$autor." - Assunto: ".$assunto;
					$query = "SELECT id_livro, titulo, autor, area_conhecimento FROM Livro WHERE ativo = 1 AND MATCH(autor) AGAINST (?) AND area_conhecimento = ? ORDER BY $ordem ASC;";
					$stmt = $conn->prepare($query);
					$stmt->bind_param("ss", $autor, $assunto);
				}
				else if (!isset($titulo) && isset($autor) && !isset($assunto))
				{
					$cabecalho_tabela .= "Consulta Livro - Todas Escolas - Autor: ".$autor;
					$query = "SELECT id_livro, titulo, autor, area_conhecimento FROM Livro WHERE ativo = 1 AND MATCH(autor) AGAINST (?) ORDER BY $ordem ASC;";
					$stmt = $conn->prepare($query);
					$stmt->bind_param("s", $autor);
				}
				else if (!isset($titulo) && !isset($autor) && isset($assunto))
				{
					$cabecalho_tabela .= "Consulta Livro - Todas Escolas - Assunto: ".$assunto;
					$query = "SELECT id_livro, titulo, autor, area_conhecimento FROM Livro WHERE ativo = 1 AND area_conhecimento = ? ORDER BY $ordem ASC;";
					$stmt = $conn->prepare($query);
					$stmt->bind_param("s", $assunto);
				}
				else if (!isset($titulo) && !isset($autor) && !isset($assunto))
				{
					$cabecalho_tabela .= "Consulta Livro - Todas Escolas - Todos livros";
					$query = "SELECT id_livro, titulo, autor, area_conhecimento FROM Livro WHERE ativo = 1 ORDER BY $ordem ASC;";
					$stmt = $conn->prepare($query);
				}
				
				
			}

			else { //escolhido apenas 1 escola
			if (isset($titulo) && isset($autor) && isset($assunto))
			{
				$cabecalho_tabela .= "Consulta Livro - Escola ".$id_escola." - Titulo: ".$titulo." - Autor: ".$autor." - Assunto: ".$assunto;
				$query = "SELECT id_livro, titulo, autor, area_conhecimento FROM Livro WHERE ativo = 1 AND id_escola = ? AND MATCH(titulo, sub_titulo) AGAINST (?) AND MATCH(autor) AGAINST (?) AND area_conhecimento = ? ORDER BY $ordem ASC;";
				$stmt = $conn->prepare($query);
				$stmt->bind_param("ssss", $id_escola, $titulo, $autor, $assunto);
			}
			else if (isset($titulo) && isset($autor) && !isset($assunto))
			{
				$cabecalho_tabela .= "Consulta Livro - Escola ".$id_escola." - Titulo: ".$titulo." - Autor: ".$autor;
				$query = "SELECT id_livro, titulo, autor, area_conhecimento FROM Livro WHERE ativo = 1 AND id_escola = ? AND MATCH(titulo, sub_titulo) AGAINST (?) AND MATCH(autor) AGAINST (?) ORDER BY $ordem ASC;";
				$stmt = $conn->prepare($query);
  				$stmt->bind_param("sss", $id_escola, $titulo, $autor);
			}
			else if (isset($titulo) && !isset($autor) && isset($assunto))
			{
				$cabecalho_tabela .= "Consulta Livro - Escola ".$id_escola." - Titulo: ".$titulo." - Assunto: ".$assunto;
				$query = "SELECT id_livro, titulo, autor, area_conhecimento FROM Livro WHERE ativo = 1 AND id_escola = ? AND MATCH(titulo, sub_titulo) AGAINST (?) AND area_conhecimento = ? ORDER BY $ordem ASC;";
				$stmt = $conn->prepare($query);
 				$stmt->bind_param("sss", $id_escola, $titulo, $assunto);
			}
			else if (isset($titulo) && !isset($autor) && !isset($assunto))
			{
				$cabecalho_tabela .= "Consulta Livro - Escola ".$id_escola." - Titulo: ".$titulo;
				$query = "SELECT id_livro, titulo, autor, area_conhecimento FROM Livro WHERE ativo = 1 AND id_escola = ? AND MATCH(titulo, sub_titulo) AGAINST (?) ORDER BY $ordem ASC;";
				$stmt = $conn->prepare($query);
  				$stmt->bind_param("ss", $id_escola, $titulo);
			}
			else if (!isset($titulo) && isset($autor) && isset($assunto))
			{
				$cabecalho_tabela .= "Consulta Livro - Escola ".$id_escola." - Autor: ".$autor." - Assunto: ".$assunto;
				$query = "SELECT id_livro, titulo, autor, area_conhecimento FROM Livro WHERE ativo = 1 AND id_escola = ? AND MATCH(autor) AGAINST (?) AND area_conhecimento = ? ORDER BY $ordem ASC;";
				$stmt = $conn->prepare($query);
  				$stmt->bind_param("sss", $id_escola, $autor, $assunto);
			}
			else if (!isset($titulo) && isset($autor) && !isset($assunto))
			{
				$cabecalho_tabela .= "Consulta Livro - Escola ".$id_escola." - Autor: ".$autor;
				$query = "SELECT id_livro, titulo, autor, area_conhecimento FROM Livro WHERE ativo = 1 AND id_escola = ? AND MATCH(autor) AGAINST (?) ORDER BY $ordem ASC;";
				$stmt = $conn->prepare($query);
				$stmt->bind_param("ss", $id_escola, $autor);
			}
			else if (!isset($titulo) && !isset($autor) && isset($assunto))
			{
				$cabecalho_tabela .= "Consulta Livro - Escola ".$id_escola." - Assunto: ".$assunto;
				$query = "SELECT id_livro, titulo, autor, area_conhecimento FROM Livro WHERE ativo = 1 AND id_escola = ? AND area_conhecimento = ? ORDER BY $ordem ASC;";
				$stmt = $conn->prepare($query);
				$stmt->bind_param("ss", $id_escola, $assunto);
			}
			else if (!isset($titulo) && !isset($autor) && !isset($assunto))
			{
				$cabecalho_tabela .= "Consulta Livro - Escola ".$id_escola." - Todos livros";
				$query = "SELECT id_livro, titulo, autor, area_conhecimento FROM Livro WHERE ativo = 1 AND id_escola = ? ORDER BY $ordem ASC;";
				$stmt = $conn->prepare($query);
				$stmt->bind_param("s", $id_escola);
				
			}
			}
			//show results of SELECT
			$stmt->execute();
			$result = $stmt->get_result();
			#$result = $conn->query($query);
			if ($result->num_rows > 0) 
			{
	    		// output data of each row
	   		 	/*while($row = $result->fetch_assoc()) 
	   		 	{
	        	echo "Codigo: " . $row["id_livro"]. " - Titulo: " . $row["titulo"]. " - Autor: " . $row["autor"]. " - Assunto: " . $row["area_conhecimento"] . "<br>"; */

	        	$string_tabela .= "
	        	<table>
	        		<thread>
					<tr>
						<th width='80'>Código</th>
						<th>Titulo</th>
						<th>Autor</th>
						<th width='20%'>Assunto</th>
					</tr>
					</thread>
				";
				while($row = $result->fetch_assoc())
				{
					$string_tabela .= " <tr>";
						$string_tabela .= "<td>" .$row["id_livro"] . "</td>";
						$string_tabela .= "<td>" .$row["titulo"] . "</td>";
						$string_tabela .= "<td>" .$row["autor"] . "</td>";
						$string_tabela .= "<td>" .$row["area_conhecimento"] ."</td>";
					$string_tabela .= "</tr>";
					
				}

				$string_tabela .= "</table>";
	   		}

	   	

				 
			else
			{
		    	$string_tabela .= "
	        	<table>
	        		<thread>
					<tr>
						<th width='80'>Código</th>
						<th>Titulo</th>
						<th>Autor</th>
						<th width='20%'>Assunto</th>
					</tr>
					</thread>
					</table>
				";
			}
	    }
	}

	echo $string_tabela;
	$_SESSION["cabecalho"] = $cabecalho_tabela;
    $_SESSION["tabela"] = $string_tabela;
    print "\r\n";
	?>
			
			</div>
		</div>
    </div>
<?php
  rodape();
?>
