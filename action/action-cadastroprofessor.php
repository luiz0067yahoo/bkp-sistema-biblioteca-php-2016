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

		function cadastroprofessor($nome, $id_escola)
		{
			include 'database.php';
			
			//calculate id for Professor
			$sqlprofessor = "SELECT RIGHT(MAX(id_professor) + 1, 4) FROM Professor WHERE id_escola = ?";
			$stmt = $conn->prepare($sqlprofessor);
			$stmt->bind_param("s", $id_escola);
			if(!$stmt->execute())
				return("Erro na inserção do Professor");
			$stmt->store_result();
			$id_professor = -1;
			$stmt->bind_result($id_professor);
			$stmt->fetch();
			
			$id_professor = $id_escola . (string)$id_professor;
			if (strlen($id_professor) != 6)
				return("Erro na inserção do Professor");
			
			//Insere professor
			$sql = "INSERT INTO Professor(id_professor, nome, id_escola) values (?, ?, ?); ";
			$stmt_insert = $conn->prepare($sql);
			$stmt_insert->bind_param("sss", $id_professor, $nome, $id_escola);
	
			if ($stmt_insert->execute()) {
				return("Cadastro Realizado com Sucesso<br>Nome: " . $nome . "<br>Código: " . $id_professor);
			} else {
				return("Error: " . $sql . "<br>" . $conn->error);
			}
			
			$conn->close();
		}

		$nome = $_POST["nomeProfessor"];
		$nome = strtoupper($nome);
		$id_escola = $_POST["Escola"];

		echo '<p id="informacao">' . cadastroprofessor($nome, $id_escola) . '</p>';
		?> 
		
		<</div>
    </div>
<?php
  rodape();
?>