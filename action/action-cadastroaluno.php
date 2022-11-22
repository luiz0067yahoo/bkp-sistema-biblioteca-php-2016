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

		function cadastroaluno($nome, $id_escola, $date)
		{
			include 'database.php';
			
			//Calcula id do Aluno
			$sqlaluno = "SELECT RIGHT(MAX(id_aluno) + 1, 6) FROM Aluno WHERE id_escola = ?";
			$stmt = $conn->prepare($sqlaluno);
			$stmt->bind_param("s", $id_escola);
			if(!$stmt->execute())
				return("Erro na inserção do Aluno");
			$stmt->store_result();
			$id_aluno = -1;
			$stmt->bind_result($id_aluno);
			$stmt->fetch();
			
			$id_aluno = $id_escola . (string)$id_aluno;
			if (strlen($id_aluno) != 8)
				return("Erro na inserção do Aluno");



			// mysqli_select_db($conn,"wp");
			$sql = "INSERT INTO Aluno(id_aluno, nome, id_escola, aniversario) values (?, ?, ?, ?)";
			$stmt_insert = $conn->prepare($sql);
			$stmt_insert->bind_param("ssss", $id_aluno, $nome, $id_escola, $date);
			if($stmt_insert->execute()){
				return("Cadastro Realizado com Sucesso<br>Nome: " . $nome . "<br>Código: " . $id_aluno);
			} else {
				return("Erro na inserção do Aluno");
			}
			

			
			$conn->close();
		}
		$nome = $_POST["nomeAluno"];
		$nome = strtoupper($nome);
		$id_escola = $_POST["Escola"];
		$input_date=$_POST['bday'];
        $date=date("Y-m-d H:i:s",strtotime($input_date));

        echo '<p id="informacao">' . cadastroaluno($nome, $id_escola, $date) . '</p>';



		?> 
		
		</div>
    </div>
<?php
  rodape();
?>
