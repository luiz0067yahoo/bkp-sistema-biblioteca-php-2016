<?php
  require_once('../cebecalhorodape.php');
  cabecalho(2,1);
?>
    <div id="site_content">
      <div id="content">
      	<a href="../cadastro.php"><img src="../style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
        </a>
        <br>
		<?php 

		function cadastroLivro($titulo, $subtitulo, $autor, $tipo_obra, $area_conhecimento, $origem, $edicao, $isbn, $serie, $id_escola){

			include 'database.php';

			//Calcula id do livro
			
			$sqllivro = "SELECT RIGHT(MAX(id_livro + 1), 6) FROM Livro WHERE id_escola = ?";
			$stmt = $conn->prepare($sqllivro);
			$stmt->bind_param("s", $id_escola);
			if(!$stmt->execute())
				return ("Erro na inserção do Livro");
			$stmt->store_result();
			$id_livro = -1;
			$stmt->bind_result($id_livro);
			$stmt->fetch();
			
			$id_livro = $id_escola . (string)$id_livro;
			if (strlen($id_livro) != 8)
				return("Erro na inserção do Livro");
			

			$sql = "INSERT INTO Livro(id_livro, titulo, tipo_obra, area_conhecimento, id_escola, origem, sub_titulo, numero_edicao, isbn, serie, autor) values 
			(?,?,?,?,?,?,?,?,?,?,?)";

			$stmt_insert = $conn->prepare($sql);
			$stmt_insert->bind_param("sssssssssss", $id_livro, $titulo, $tipo_obra, $area_conhecimento, $id_escola, $origem, $subtitulo, $edicao, $isbn, $serie, $autor);

			
			if($stmt_insert->execute()){
				return('Cadastro Realizado com Sucesso<br>
				Código: ' . $id_livro . '<br>Título: ' . $titulo);
			} else {
				return("Erro na inserção do Livro");
			}

		}

		$titulo = $_POST["tituloLivro"];
		$titulo = strtoupper($titulo);
		$subtitulo = isset($_POST["subtituloLivro"]) ? $_POST["subtituloLivro"] : '';
		$autor = $_POST["autorLivro"];
		$tipo_obra = $_POST["tipoobraLivro"];
		$area_conhecimento = $_POST["areaLivro"];
		$origem = $_POST["origemLivro"];
		$edicao = (INT)(isset($_POST["edicaoLivro"]) ? $_POST["edicaoLivro"] : '0');
		$isbn = isset($_POST["isbnLivro"]) ? $_POST["isbnLivro"] : '';
		$serie = isset($_POST["serieLivro"]) ? $_POST["serieLivro"] : '';
		$id_escola = $_POST["Escola"];
		
	

		echo '<p id="informacao">' . cadastroLivro($titulo, $subtitulo, $autor, $tipo_obra, $area_conhecimento, $origem, $edicao, $isbn, $serie, $id_escola) . '</p>';
	
		?> 
		</div>
    </div>
<?php
  rodape();
?>
