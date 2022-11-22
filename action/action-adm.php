<?php
	include_once('../cebecalhorodape.php');
  cabecalho(6,1);
?>
    <div id="site_content">
      <div id="content">
		<a href="../adm.php"><img src="../style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
        </a>
        <br>

		<?php 

		include 'database.php';
			
		

		switch ($_GET["id"]) {
			case 1: //Configuracao multa
				$valor_multa = $_POST["valorMulta"];
				$escola = $_POST["Escola"];
				$emprestimo_com_multa = $_POST["permitir_emprestimo_multa"];



				$sql1 = "UPDATE Escola SET valor_multa_dia = ?, permitir_emprestimo_aluno_com_multa = ? WHERE id_escola = ?";
				$stmt = $conn->prepare($sql1);
				$stmt->bind_param("dsi", $valor_multa, $emprestimo_com_multa, $escola);
				if ($stmt->execute())
				{
					echo '<p id="informacao">Valor R$ ' . number_format((float)($valor_multa), 2, '.', '') . ' atualizado para a escola ' . $escola . '.</p>';
				}
				else
					echo '<p> Falha ao atualizar o valor da multa';

				break;

				case 2: //Configuracao de emprestimos
					$valor_limite = $_POST["valorLimite"];
					$escola = $_POST["Escola"];
					$prazo = $_POST["prazo"];
					$comprovante = $_POST["imprimir_comprovante"];

					$sql2 = "UPDATE Escola SET limite_emprestimos_aluno = ?, prazo_padrao = ?, imprimir_emprestimo = ? WHERE id_escola = ?";
					$stmt = $conn->prepare($sql2);
					$stmt->bind_param("iiis",$valor_limite, $prazo, $comprovante, $escola);
					if ($stmt->execute())
						echo '<p id="informacao"> Configuracao alterada com sucesso.';
					else
						echo '<p id="informacao">Falha ao alterar o limite.';
					break;

				case 6: //Exclusao livro
					
					$id_livro = $_POST["codLivro"];

					$sql6 = "UPDATE Livro SET ativo = FALSE WHERE id_livro = ?";
					$stmt = $conn->prepare($sql6);
					$stmt->bind_param("s", $id_livro);
					if ($stmt->execute()){
						if($stmt->affected_rows > 0)
							echo '<p id="informacao">Livro ' . $id_livro . ' excluido com sucesso.</p>';
						else
							echo '<p id="informacao">Livro não existente.</p>';
					}
					else
						echo '<p id="informacao">Falha ao excluir o livro.</p>';
					break;
				case 7: //Exclusao aluno
					$id_aluno = $_POST["codAluno"];

					$sql7 = "UPDATE Aluno SET ativo = FALSE WHERE id_aluno = ?";
					$stmt = $conn->prepare($sql7);
					$stmt->bind_param("s", $id_aluno);
					if ($stmt->execute()){
						if($stmt->affected_rows > 0)
							echo '<p id="informacao">Aluno ' . $id_aluno . ' excluido com sucesso.</p>';
						else
							echo '<p id="informacao">Aluno não existente.</p>';
					}
					else
						echo '<p id="informacao">Falha ao excluir o aluno.</p>';
					break;
				
				case 8: //Exclusao professor
					$id_professor = $_POST["codProfessor"];

					$sql8 = "UPDATE Professor SET ativo = FALSE WHERE id_professor = ?";
					$stmt = $conn->prepare($sql8);
					$stmt->bind_param("s", $id_professor);
					if ($stmt->execute()){
						if($stmt->affected_rows > 0)
							echo '<p id="informacao">Professor ' . $id_professor . ' excluido com sucesso.</p>';
						else
							echo '<p id="informacao">Professor não existente.</p>';
					}
					else
						echo '<p id="informacao">Falha ao excluir o professor.</p>';
					break;
				case 9: //Exclusao emprestimo
					$id_emprestimo = $_POST["codEmprestimo"];

					$sql9 = "UPDATE Emprestimo SET concluido = TRUE WHERE id_emprestimo = ?";
					$stmt = $conn->prepare($sql9);
					$stmt->bind_param("s", $id_emprestimo);
					if ($stmt->execute()){
						if($stmt->affected_rows > 0)
							echo '<p id="informacao">Emprestimo ' . $id_emprestimo . ' excluido com sucesso.</p>';
						else
							echo '<p id="informacao">Emprestimo não existente.</p>';
					}
					else
						echo '<p id="informacao">Falha ao excluir o emprestimo.</p>';
					break;
			default:
				
				break;
		}






		$conn->close();




		
    print "\r\n";
	?> 

		</div>
    </div>
<?php
  rodape();
?>