<!DOCTYPE html>
<html>
<head>
	<title>Emprestimos</title>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<style>
		.boxed 
		{	
			width:700px;
			height: 50px;
  			border: 1px solid black ;
  			margin-top: 0px;
  			margin-bottom: 0px;

		}

		p {
	     	white-space: nowrap;
	     	
	     	overflow: hidden;
	     	text-overflow: ellipsis;
	     	margin-top: 0;
	    	margin-bottom: 0;
	    	margin-left: 5px;
	    	margin-right: 5px;
 		}
		#p01 { width: 680px; }
		#p02 { width: 680px; }
		.container {
		  
		    padding: 0px;
		}

		.column1 {
			float: left;
			width: 20%;
			margin-top: 2px;
		}
		.column2 {
			float: left;
			width: 80%;
		}

		/* Clear floats after the columns */
		.row:after {
			content: "";
			display: table;
			clear: both;
		}
		

	</style>
</head>
<body>
	
	
	<section class="container">
    
    	
			

			<?php
			
			include 'database.php';
			include 'escola.php';
				
				if ($_GET["id"] == 1)
				{
					$query_quantidade = "SELECT MAX(id_emprestimo) FROM Emprestimo where id_escola = '".$id_escola_atual."'";
					$result_quantidade = $conn->query($query_quantidade);
					$row_quantidade = $result_quantidade->fetch_assoc();
					$id_emprestimo = $row_quantidade["MAX(id_emprestimo)"];

				}
				else
					$id_emprestimo = $_GET["codigo"];
				$query = "SELECT YEAR(data_devolucao) AS anoDevolucao, MONTH(data_devolucao) AS mesDevolucao, DAY(data_devolucao) AS diaDevolucao, id_livro, id_aluno FROM Emprestimo WHERE id_emprestimo = '$id_emprestimo';";
				
				$result = $conn->query($query);
				if ($result->num_rows > 0) {
   				 // output data of each row
	    			while($row = $result->fetch_assoc()){
	       				 $anoDevolucao = $row["anoDevolucao"];
	       				 $mesDevolucao = $row["mesDevolucao"];
	       				 $diaDevolucao = $row["diaDevolucao"];
	       				 $id_livro = $row["id_livro"];
	       				 $id_aluno = $row["id_aluno"];
	       				}
	       				 $queryaluno = "SELECT nome FROM Aluno WHERE id_aluno = '$id_aluno';";
	       				 $resultaluno = $conn->query($queryaluno);
	       				 if($resultaluno->num_rows > 0)
	       				 {
	       				 	while($rowaluno = $resultaluno->fetch_assoc()){
	       				 	$nome_aluno = $rowaluno["nome"];
	       				 	}
	       				 }
	       				 $querylivro = "SELECT titulo FROM Livro WHERE id_livro = '$id_livro';";
	       				 $resultlivro = $conn->query($querylivro);
	       				 if($resultlivro->num_rows > 0)
	       				 {
	       				 	while($rowlivro = $resultlivro->fetch_assoc()){
	       				 	$titulo = $rowlivro["titulo"];
	       				 	}
	       				 }
				} 
				else {
			    	//echo "0 resultados";
			    	die();
				}
			




			/*echo '<div class="boxed">';
			
			echo ' <p id="p01"><img src="barcode.php?f=png&s=code-128&w=130&ts=3&h=35&th=11&d='.$id_emprestimo.'">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>LIVRO</b>: ' . $id_livro . ' - ' . $titulo . '</p>';
			echo '<p id="p02">Devolução: ' . $diaDevolucao . '/' . $mesDevolucao . '/' . $anoDevolucao . ' &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>ALUNO</b>: ' . $id_aluno . ' - ' . $nome_aluno;

			echo '</div>';*/

			echo '<div class="boxed">';
			echo '<div class="row">
			<div class="column1"><p><img src="barcode.php?f=png&s=code-128&w=130&ts=3&h=40&th=11&d='.$id_emprestimo.'"></p></div>
			<div class="column2"><p>Devolução: ' . $diaDevolucao . '/' . $mesDevolucao . '/' . $anoDevolucao . ' &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>ALUNO</b>: ' . $id_aluno . ' - ' . $nome_aluno.'</p><p><b>LIVRO</b>: ' . $id_livro . ' - ' . $titulo . '</p></div>
		  	</div>';
			
			?>
			
		

   
    
</section>
	  	



</body>
</html>