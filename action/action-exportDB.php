<?php
  require_once('../cebecalhorodape.php');
  cabecalho(6,1);
?>
    <div id="site_content">
      <div id="content">
		<br>
		<a href="../adm.php"><img src="../style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
        </a>
        <br> <br>
		<?php 
		include 'database.php';
		include 'escola.php';
		

		$query_exportDB = "SELECT * INTO OUTFILE '/home/professor/Downloads/backup01.csv'
  		FIELDS TERMINATED BY ',' ENCLOSED BY '\"'
  		LINES TERMINATED BY '\n'
  		FROM Livro WHERE id_escola = '".$id_escola_atual."' AND ativo = TRUE;";

  		if ($conn->query($query_exportDB) === TRUE)
				{
					echo '<p id="informacao">Backup realizado com sucesso, o arquivo está na Área de Trabalho</p>';
					
					
				}
				else
					echo '<p> Falha ao realizar o backup';

		$conn->close();
		?> 
		</div>
    </div>
<?php
  rodape();
?>
