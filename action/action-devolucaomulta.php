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

		$cobrar = $_GET["cobrar"];
		$id_emprestimo = $_GET["id_emprestimo"];
		$multa = $_GET["multa"];

		function fdevolucao($cobrar, $id_emprestimo, $multa)
		{
			include 'database.php';
		
			if ($cobrar)
			{
				$sql_multa = "UPDATE Emprestimo set multa_devendo = ? where id_emprestimo = ?;";

				$stmt_multa = $conn->prepare($sql_multa);
				$stmt_multa->bind_param("ds", $multa, $id_emprestimo);
				if($stmt_multa->execute()){
					return('Multa registrada com sucesso.<br><form method="post" action="action-pagamentomulta.php?idEmprestimo='. $id_emprestimo . '&valorMulta='. $multa .'">
	            <button type="submit" class="buttonenviar">Confirmar Pagamento</button></form>');
				} else {
				return("Ocorreu um erro, por favor verifique os dados e tente novamente");
				}
			}
			else
			{	
				$sql_devolve = "UPDATE Emprestimo SET concluido = TRUE WHERE id_emprestimo = ?;";
				$stmt_update = $conn->prepare($sql_devolve);
				$stmt_update->bind_param("s", $id_emprestimo);
				if($stmt_update->execute()){
					return("Devolução Realizada com Sucesso");
				} else {
					return("Ocorreu um erro, por favor verifique os dados e tente novamente");
				}
			}
			


			$conn->close();
		}

		echo '<p id="informacao">' . fdevolucao($cobrar, $id_emprestimo, $multa) . '</p>';

		?> 
		</div>
		</div>
<?php
  rodape();
?>
