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

		$id_livro = $_POST["codLivro"];

		function fdevolucao($id_livro)
		{
			include 'database.php';
			
			//find ID for Emprestimo
			$sql_id_emprestimo = "SELECT id_emprestimo, Escola.valor_multa_dia, DATEDIFF(CURDATE(), data_devolucao), Emprestimo.id_professor as professor FROM Emprestimo JOIN Escola on Emprestimo.id_escola = Escola.id_escola where id_livro = ? AND concluido = FALSE ORDER BY Emprestimo.id_emprestimo DESC LIMIT 1;";
			#$result_id_emprestimo = $conn->query($sql_id_emprestimo);
			$stmt = $conn->prepare($sql_id_emprestimo);
			$stmt->bind_param("s", $id_livro);
			$stmt->execute();
			$result_id_emprestimo = $stmt->get_result();
			if ($result_id_emprestimo->num_rows == 0)
				return ("O Livro não está emprestado");
			$row = $result_id_emprestimo->fetch_assoc();
			$id_emprestimo = $row["id_emprestimo"];
			if ($row["professor"] == NULL)
			{
				
				$valor_multa = $row["valor_multa_dia"];
				$dias_multa = $row["DATEDIFF(CURDATE(), data_devolucao)"];
				if($dias_multa > 0 && $valor_multa != 0)
				{
					return( "Valor da multa: R$" .number_format((float)($valor_multa * $dias_multa), 2, '.', '') ."<br> Cobrar a multa?" . '<br><div style="float:left"><form method="post" action="action-devolucaomulta.php?cobrar=1&id_emprestimo=' . $id_emprestimo .
					'&multa=' . ($valor_multa * $dias_multa) .'">
		            <button type="submit" class="buttonenviar">SIM</button>
		          </form>  </div> <div> <form method="post" action="action-devolucaomulta.php?cobrar=0&id_emprestimo=' . $id_emprestimo .'&multa=' . ($valor_multa * $dias_multa) .'">
		            <button type="submit" class="buttonenviar">NÃO</button></form></div>');

		           
				}
			}

			
			$sql_devolve = "UPDATE Emprestimo SET concluido = TRUE WHERE id_emprestimo = ?;";
			$stmt_update = $conn->prepare($sql_devolve);
			$stmt_update->bind_param("s", $id_emprestimo);
			if($stmt_update->execute()){
				return("Devolução Realizada com Sucesso");
			} else {
				return("Ocorreu um erro, por favor verifique os dados e tente novamente");
			}

		}

		echo '<p id="informacao">' . fdevolucao($id_livro) . '</p>';

		?> 

		</div>
    </div>
<?php
  rodape();
?>
