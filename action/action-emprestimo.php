<?php
  require_once('../cebecalhorodape.php');
  cabecalho(0,1);
?>
	<div id="site_content">
      <div id="content">
		<br>
		<a href="../index.php"><img src="../style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
        </a>
        <br> <br>
		<?php 
		$id_aluno = $_POST["codAluno"];
		$id_livro = $_POST["codLivro"];
		$prazo = $_POST["prazo"];
		function femprestimo($id_aluno, $id_livro, $prazo)
		{	
			include 'database.php';
				
			$id_escola = $id_aluno[0] . $id_aluno[1];
			if ($id_escola != $id_livro[0] . $id_livro[1])
					return("Não é possível realizar o empréstimo entre escolas");
			$sql = "SELECT id_emprestimo FROM Emprestimo WHERE id_escola = $id_escola;";
			$result = $conn->query($sql);
			

			$sqlemprestimo = "SELECT RIGHT(MAX(id_emprestimo + 1), 9) FROM Emprestimo WHERE id_escola = ?";
			$stmt = $conn->prepare($sqlemprestimo);
			$stmt->bind_param("s", $id_escola);
			if(!$stmt->execute())
				return ("Erro no empréstimo, por favor tente novamente");
			$stmt->store_result();
			$id_emprestimo = -1;
			$stmt->bind_result($id_emprestimo);
			$stmt->fetch();
			
			$id_emprestimo = $id_escola . (string)$id_livro;
			if (strlen($id_emprestimo) != 11)
				return("Erro no empréstimo, por favor tente novamente");
			
			//verifica se o livro está emprestado
			$sql_emprestado = "SELECT id_emprestimo FROM Emprestimo WHERE id_livro = ? AND concluido = FALSE AND multa_devendo = 0 ";
			//$result_emprestado = $conn->query($sql_emprestado);
			$stmt_emprestado = $conn->prepare($sql_emprestado);
			$stmt_emprestado->bind_param("s", $id_livro);
			$stmt_emprestado->execute();
			$result_emprestado = $stmt_emprestado->get_result();
			if ($result_emprestado->num_rows > 0)
				return("O Livro já está emprestado!");


			if (strlen($id_aluno) == 8) //emprestimo aluno
			{
				
				$operation_id = 0; //operacao para emprestimo de aluno
				$sql_aluno_limite = "SELECT COUNT(Emprestimo.id_emprestimo) as Quantidade,(SELECT permitir_emprestimo_aluno_com_multa FROM Escola where id_escola = ?) as permitir_emprestimo_multa ,(SELECT limite_emprestimos_aluno FROM Escola WHERE id_escola = ?) as Limite, Aluno.ativo, (SELECT ativo FROM Livro where id_livro = ?) as livroAtivo, Aluno.nome as nome, (SELECT titulo  from Livro where id_livro = ?) as titulo FROM Aluno JOIN Emprestimo ON Aluno.id_aluno = Emprestimo.id_aluno WHERE Emprestimo.concluido = FALSE AND Aluno.id_aluno = ?";
				$stmt_aluno_limite = $conn->prepare($sql_aluno_limite);
				$stmt_aluno_limite->bind_param("sssss", $id_escola, $id_escola, $id_livro, $id_livro, $id_aluno);
				$stmt_aluno_limite->execute();
				$result_aluno_limite = $stmt_aluno_limite->get_result();
				//$result_aluno_limite = $conn->query($sql_aluno_limite);
				$row_limite = $result_aluno_limite->fetch_assoc();
				if ($row_limite["nome"] == NULL)
					return("O Código do Aluno está incorreto!");
				if ($row_limite["titulo"] == NULL)
					return("O Código do Livro está incorreto");
				$sql_emprestimo_com_multa = "SELECT SUM(CASE WHEN multa_devendo > 0 THEN 1 ELSE 0 END) as quantidade_multa FROM Emprestimo JOIN Aluno ON Emprestimo.id_aluno = Aluno.id_aluno WHERE Aluno.id_aluno = ?;"; //Seleciona a quantidade de emprestimos com multa que o aluno tem
				$stmt_emprestimo_com_multa = $conn->prepare($sql_emprestimo_com_multa);
				$stmt_emprestimo_com_multa->bind_param("s", $id_aluno);
				$stmt_emprestimo_com_multa->execute();
				$result_emprestimo_com_multa = $stmt_emprestimo_com_multa->get_result();
				//$result_emprestimo_com_multa = $conn->query($sql_emprestimo_com_multa);
				$row_emprestimo_com_multa = $result_emprestimo_com_multa->fetch_assoc();
				if($row_limite["permitir_emprestimo_multa"]){ 		//escola permite emprestimo de aluno com multa
					if ($row_limite["Quantidade"] - $row_emprestimo_com_multa["quantidade_multa"] >= $row_limite["Limite"])
						return("O aluno atingiu o limite de empréstimos simultaneos!");
				}
				else if ($row_limite["Quantidade"] >= $row_limite["Limite"]){ 		//escola nao permite emprestimo de aluno com multa
					return("O aluno atingiu o limite de empréstimos simultaneos!");
				}

				if ($row_limite["ativo"] == 0)
					return ("Este aluno está desativado!");
				if($row_limite["livroAtivo"] == 0)
					return ("Este livro está desativado!");
				$sqlquery = "INSERT INTO Emprestimo VALUES ('$id_emprestimo', '$id_escola', '$id_aluno', NULL, '$id_livro', 0, 0, CURDATE(), DATE_ADD(CURDATE(), INTERVAL $prazo DAY), FALSE);";

			}
			else if (strlen($id_aluno) == 6) //emprestimo professor
			{
				$operation_id = 1; //operacao para emprestimo de professor
				$sql_professor_ativo = "SELECT ativo, (SELECT ativo FROM Livro where id_livro = '$id_livro') as livroAtivo, (SELECT titulo FROM Livro where id_livro = '$id_livro') as tituloLivro , nome FROM Professor WHERE id_professor = '$id_aluno'";
				$result_professor_ativo = $conn->query($sql_professor_ativo);
				$row_ativo = $result_professor_ativo->fetch_assoc();
				if ($row_ativo["ativo"] == 0)
					return ("Este professor está desativado!");
				if($row_ativo["livroAtivo"] == 0)
				{
					return("Este livro está desativado!");
				}
				$sqlquery = "INSERT INTO Emprestimo VALUES ('$id_emprestimo', '$id_escola', NULL, '$id_aluno', '$id_livro', 0, 0 , CURDATE(), DATE_ADD(CURDATE(), INTERVAL $prazo DAY), FALSE);";
			}
			else 
				return("Código do emprestante inválido!");

			


			if ($conn->query($sqlquery) === TRUE) {
				$query_impressao = "SELECT imprimir_emprestimo FROM Escola where id_escola = '".$id_escola."'";
				$result_impressao = $conn->query($query_impressao);
				$row_impressao = $result_impressao->fetch_assoc();
				if ($row_impressao["imprimir_emprestimo"])
					echo '<script type="text/javascript">window.open("http://biblioteca.com:8081/action/action-imprimeemprestimo.php?codigo='.$id_emprestimo.'")</script>';
				switch ($operation_id)
				{
					case 0: //emprestimo aluno
						return ('Emprestimo Realizado com Sucesso<br>Aluno: ' . $row_limite["nome"] . '<br>Livro: ' . $row_limite["titulo"] . ' <br> Código Empréstimo: ' . $id_emprestimo);
						break;
					
					case 1:
						return ('Emprestimo Realizado com Sucesso<br>Professor: ' . $row_ativo["nome"] . '<br>Livro: ' . $row_ativo["tituloLivro"] . ' <br> Código Empréstimo: ' . $id_emprestimo);
						break;
				}
				
			} else {
				return ("Ocorreu um erro, por favor verifique os dados e tente novamente");
			} 
			$conn->close();
		}

		echo '<p id="informacao">' . femprestimo($id_aluno, $id_livro, $prazo) . '</p>';
		?> 
		</div>
    </div>
<?php
  rodape();
?>
