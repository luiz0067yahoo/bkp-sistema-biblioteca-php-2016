<?php
  require_once('../cebecalhorodape.php');
  cabecalho(5,1);
?>
    <div id="site_content">
      <div id="content">
		<a href="../relatorio.php"><img src="../style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
        </a>
        <br>
		<?php 	
			include 'database.php';

			$input_date_inicial = $_POST["dataInicial"];
			$data_inicial =date("Y-m-d H:i:s",strtotime($input_date_inicial));

			$input_date_final = $_POST["dataFinal"];
			$data_final =date("Y-m-d H:i:s",strtotime($input_date_final));
			$id_escola = $_POST["Escola"];
			$query = "SELECT SUM(multa_paga) as valor FROM Emprestimo WHERE id_escola = '$id_escola' AND DATEDIFF('$data_inicial', Emprestimo.data_emprestimo) <= 0 AND DATEDIFF('$data_final', Emprestimo.data_emprestimo) >= 0 AND concluido = 1";

			$result = $conn->query($query);
			if ($result->num_rows > 0) 
			{
				$row = $result->fetch_assoc();
				echo '<br><p>Valor total arrecadado: R$ ' .number_format((float)($row["valor"]), 2, '.', '') .'
      					</p>';
			}
			else
			{
				echo "<br>0 resultados.";
			}
		?>

		</div>
    </div>
<?php
  rodape();
?>
