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

		$query_importDB = "CREATE TABLE Livro_Backup LIKE Livro;";
		$query_importDB .= "LOAD DATA INFILE '/home/professor/Documentos/backup01.csv' 
     			INTO TABLE Livro_Backup
     				FIELDS TERMINATED BY ',' ENCLOSED BY '\"'
     					LINES TERMINATED BY '\n'  
    					(id_livro,titulo,sub_titulo,autor ,tipo_obra,area_conhecimento,origem,numero_edicao,isbn,serie,id_escola,ativo);";
    	$query_importDB .= "SET SQL_SAFE_UPDATES=0; DELETE Livro_Backup
						FROM Livro_Backup INNER JOIN Livro ON Livro.id_livro = Livro_Backup.id_livro;SET SQL_SAFE_UPDATES=1;";
		$query_importDB .= "INSERT INTO Livro SELECT * FROM Livro_Backup; DROP TABLE Livro_Backup;";

  		if ($conn->multi_query($query_importDB) === TRUE)
				{
					echo '<p id="informacao">Importacao realizada com sucesso</p>';
					
					
				}
				else
					echo '<p> Falha ao realizar o import';

		$conn->close();
		?> 
		</div>
    </div>
<?php
  rodape();
?>
