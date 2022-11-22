<?php
  require_once('../cebecalhorodape.php');
  cabecalho(1,1);
?>
    <div id="site_content">
      <div id="content">
		<a href="../devolucao.php"><img src="../style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
        </a>
        <br>
		<?php 
		if(isset($_GET["valorMulta"]))
		{
			if(isset($_GET["idEmprestimo"]))
			{
				$id_emprestimo = $_GET["idEmprestimo"];
				include 'database.php';
				
				
				$sql_find_aluno = "SELECT id_aluno FROM Emprestimo WHERE id_emprestimo = '$id_emprestimo'";
				$result_find_aluno = $conn->query($sql_find_aluno);
				if ($result_find_aluno->num_rows == 0)
					return ("Ocorreu um erro. Por favor, tente novamente.");
				$row = $result_find_aluno->fetch_assoc();
				$id_aluno = $row["id_aluno"];
			}
			else
				$id_aluno = $_GET["idAluno"];
				$valor_multa = $_GET["valorMulta"];

			function confirma_pagamento($id_aluno, $valor_multa)
			{
				include 'database.php';
				
				$sql_paga_multa = "UPDATE Emprestimo SET multa_devendo = 0, multa_paga = '$valor_multa', concluido = TRUE WHERE id_aluno = '$id_aluno' AND concluido = FALSE";
				if($conn->query($sql_paga_multa) === TRUE)
					return("Pagamento concluído.");
				else return ("Falha no pagamento. Por favor, tente novamente.");
			}

			echo '<p id="informacao">'. confirma_pagamento($id_aluno, $valor_multa) . '</p>';
		}
		else if(isset($_GET["idAluno"]))
		{
			$id_aluno = $_GET["idAluno"];
			function fpagamento($id_aluno)
			{
				include 'database.php';
				
				$sql_get_multa = "SELECT SUM(multa_devendo) FROM Emprestimo WHERE id_aluno = '$id_aluno' AND concluido = FALSE";
				$result_get_multa = $conn->query($sql_get_multa);
				if ($result_get_multa->num_rows == 0)
					return ("Não há multa");
				$row = $result_get_multa->fetch_assoc();
				$valor_multa = $row["SUM(multa_devendo)"];

				if ($valor_multa == 0)
				{
					return('<p id="informacao"> O valor da multa é de: R$ ' .number_format((float)($valor_multa), 2, '.', ''));
				}
				
				echo '<p id="informacao"> O valor da multa é de: R$ ' .number_format((float)($valor_multa), 2, '.', '');
				echo '<br> <p> Confirmar pagamento?';
				return('<div style="float:left"><form method="post" action="action-pagamentomulta.php?idAluno=' . $id_aluno .'&valorMulta='. $valor_multa . '">
		            <button type="submit" class="buttonenviar">SIM</button>
		          </form>  </div> <div> <form method="post" action="../devolucao.php">
		            <button type="submit" class="buttonenviar">NÃO</button></form></div>');

		        $conn->close();	
			}

			echo '<p id="informacao">' . fpagamento($id_aluno) . '</p>';

		}

		else
		{
			echo'<form method="get" action="action-pagamentomulta.php">
			<p>Código Aluno:&nbsp;
          <input type="text" name="idAluno" required autocomplete="off"><br>
          </p>
          <button type="submit" class="buttonenviar">Enviar</button>

        </form>'; 
		}

		?> 
		
    </div>
<?php
  rodape();
?>
