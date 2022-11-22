<!DOCTYPE html>
<html>
<head>
	<title>Carteirinhas Professor</title>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<style>
		.boxed 
		{	
			width:313px;
			height: 200px;
  			border: 1px solid black ;
  			margin-top: 20px;
  			margin-bottom: 20px;

		}

		p {
	     	width: 300px;
	     	white-space: nowrap;
	     	overflow: hidden;
			font-family: "Times New Roman";
	     	text-overflow: ellipsis;
	     	margin-top: 0;
	    	margin-bottom: 0;
	    	margin-left: 0;
	    	margin-right: 0;
 		}
		#p01 { margin-bottom: 5px; }
		#p02 { font-size: 12px;
			   margin-bottom: 8px; }
		#p03 { font-size: 13px;
		margin-bottom: 15px; }
		#p04 { margin-bottom: 5px; }
		.container {
		  
		    padding: 10px;
		}
		.one {
		    width: 15%;
		    float: left;
		}
		.two {
		    margin-left: 15%;
		    float: right;
		}
		}

	</style>
</head>
<body>
	
	<!-- <script> window.print(); </script> -->
	<?php
		include 'database.php';
		include 'escola.php';
		
		function verifica_ultimo ( $id_ultimo , $id_escola ){
			include 'database.php';
			if(strlen($id_ultimo) != 6)
				$id_ultimo = '0'.$id_ultimo;
			if ($id_ultimo == ($id_escola.'0000'))
				return $id_escola.'0000';
			$queryf = "SELECT ativo FROM Professor WHERE id_professor = '".$id_ultimo."';";
			
			$result = $conn->query($queryf);
			$row = $result->fetch_assoc();
			$ativo = $row["ativo"];
			if ($ativo)
				return $id_ultimo;
			return verifica_ultimo($id_ultimo - 1, $id_escola);
		}
		
		$codigos = array();
		$quantidade = 0;
		if (isset($_GET["id"]) && $_GET["id"] == 1)
		{
			$query_quantidade = "SELECT MAX(id_professor) FROM Professor where id_escola = '".$id_escola_atual."'";
			$result_quantidade = $conn->query($query_quantidade);
			$row_quantidade = $result_quantidade->fetch_assoc();
			$ultimo_registro = $row_quantidade["MAX(id_professor)"];

			for ($i = 0; $i < 8; $i++)
			{
				$ultimo_registro = verifica_ultimo( $ultimo_registro, $id_escola_atual);
				$quantidade++;

				$codigos[$i] = $ultimo_registro;
				$ultimo_registro--;
				
				if ($ultimo_registro == $id_escola_atual.'0000' - 1)
					break;
			
			}
			

		}
		else
		{
		
			for($i = 0 ;; $i++)
			{
				$nameofparamater = "codigo" . ($i + 1);
				if (isset($_GET[$nameofparamater]) && $_GET[$nameofparamater] != "")
				{
					$codigos[$i] = $_GET[$nameofparamater];
					$quantidade++;
				}
				else
					break;
			}
		}
		
		
	?>
	<section class="container">
    <div class="one">
    	
			

			<?php
			


			for ($i = 0; $i < 4 && $i < $quantidade; $i++)
			{
				$query = "SELECT  Professor.nome as nome_professor, Escola.telefone as telefone, Escola.nome as escola FROM Professor JOIN Escola ON Professor.id_escola = Escola.id_escola where id_professor = '$codigos[$i]';";
				
				$result = $conn->query($query);
				if ($result->num_rows > 0) {
   				 // output data of each row
	    			while($row = $result->fetch_assoc()) {
	       				 $nome_aluno = $row["nome_professor"];
	       				 $escola = $row["escola"];
	       				 $telefone = $row["telefone"];

					}
				} 
				else {
			    	//echo "0 resultados";
			    	die();
				}
			




			echo '<div class="boxed">';
			
			echo '<center><p> Escola Municipal ' . $escola . '</p></center>';
			echo '<center><p id="p02">Telefone: ' . $telefone . '</p></center>';
			echo '<center><p id="p03"> CARTEIRA DE IDENTIFICAÇÃO - BIBLIOTECA<br>PROFESSOR </p></center>';

			echo '<p id="p01">&nbsp&nbsp Nome: ' . $nome_aluno . '</p>';
			echo '<center><img src="barcode.php?f=png&s=code-128&w=270&ts=5&h=85&th=12&d='.$codigos[$i].'"> </center> </div> ';
			}	
			
			?>
			
		

    </div>
    <div class="two">
    	
			

			<?php

			for ($i = 4; $i < 8 && $i < $quantidade; $i++)
			{
				$query = "SELECT  Professor.nome as nome_professor, Escola.telefone as telefone, Escola.nome as escola FROM Professor JOIN Escola ON Professor.id_escola = Escola.id_escola where id_professor = '$codigos[$i]';";
				$result = $conn->query($query);
				if ($result->num_rows > 0) {
   				 // output data of each row
	    			while($row = $result->fetch_assoc()) {
						$nome_aluno = $row["nome_professor"];
						$escola = $row["escola"];
						$telefone = $row["telefone"];

					}
				} 
				else {
			    	//echo "0 resultados";
			    	die();
				}
			




				echo '<div class="boxed">';
			
				echo '<center><p> Escola Municipal ' . $escola . '</p></center>';
				echo '<center><p id="p02">Telefone: ' . $telefone . '</p></center>';
				echo '<center><p id="p03"> CARTEIRA DE IDENTIFICAÇÃO - BIBLIOTECA<br>PROFESSOR </p></center>';
	
				echo '<p id="p01">&nbsp&nbsp Nome: ' . $nome_aluno . '</p>';
				echo '<center><img src="barcode.php?f=png&s=code-128&w=270&ts=5&h=85&th=12&d='.$codigos[$i].'"> </center> </div> ';
				}	
				
				?>
			
		
    </div>
</section>
	  	



</body>
</html>
