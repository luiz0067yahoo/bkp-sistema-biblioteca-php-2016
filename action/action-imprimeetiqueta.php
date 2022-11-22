	<!DOCTYPE html>
	<html>
	<head>
		<title>Etiquetas</title>
		<style>
			.boxed 
			{	
				width:283px;
				height: 160px;
	  			border: 1px solid black ;
	  			margin-top: 20px;
	  			margin-bottom: 20px;

			}

			p {
	     	width: 268px;
	     	white-space: nowrap;
	     	overflow: hidden;
	     	text-overflow: ellipsis;
	     	margin-top: 0;
	    	margin-bottom: 0;
	    	margin-left: 0;
	    	margin-right: 0;
	}
			#p01 { margin-bottom: 5px; }
			#p02 { font-size: 12px; }
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
		<section class="container">
			<div class="one">
	<?php
		include 'bib.php';
		include 'database.php';
		include 'escola.php';
		function verifica_ultimo ( $id_ultimo , $id_escola ){
			include 'database.php';
			if(strlen($id_ultimo) != 8)
				$id_ultimo = '0'.$id_ultimo;
			if ($id_ultimo == ($id_escola.'000000'))
				return $id_escola.'000000';
			$queryf = "SELECT ativo FROM Livro WHERE id_livro = '".$id_ultimo."';";
			//echo $id_escola;
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
			$query_quantidade = "SELECT MAX(id_livro) FROM Livro where id_escola = '".$id_escola_atual."'";
			$result_quantidade = $conn->query($query_quantidade);
			$row_quantidade = $result_quantidade->fetch_assoc();
			$ultimo_registro = $row_quantidade["MAX(id_livro)"];
	
			for ($i = 0; $i < 10; $i++)
			{
				if (strlen($id_escola_atual) != 2)
					$id_escola_atual = '0'.$id_escola_atual;
				$ultimo_registro = verifica_ultimo( $ultimo_registro, $id_escola_atual);
				$quantidade++;
				$codigos[$i] = $ultimo_registro;
				$ultimo_registro--;
		
				if ($ultimo_registro == $id_escola_atual.'000000' - 1)
					break;
	
			}
	

		}
		else
		{

	
				$nameofparamater = "codigo" . ($i + 1);
				if (isset($_GET[$nameofparamater]) && $_GET[$nameofparamater] != "")
				{
					$codigos[$i] = $_GET[$nameofparamater];
					$quantidade++;
				}
		
		}
		function name_to_cdd($string)
		{
			if ($string == "Generalidade")
				return 0;
			if ($string == "Literatura Infantil")
				return 28.5;
			if ($string == "Almanaques e Enciclopédias")
				return 36.9;
			if ($string == "Filosofia")
				return 100;
			if ($string == "Educação")
				return 370;
			if ($string == "Folclore")
				return 398;
			if ($string == "Línguas")
				return 400;
			if ($string == "Matemática")
				return 510;
			if ($string == "Artes")
				return 700;
			if ($string == "Historias em Quadrinhos")
				return 711.5;
			if ($string == "Literatura Americana")
				return 813;
			if ($string == "Literatura Brasileira")
				return 869.3;
			if ($string == "História")
				return 907;
			if ($string == "Geografia")
				return 910;
		}
	

		$codigo_inicial		= (isset($_POST["codigo_inicial"]) ? $_POST["codigo_inicial"] : '');
		$codigo_final 		= (isset($_POST["codigo_final"]) ? $_POST["codigo_final"] : '');
		$titulo 		= strtoupper(isset($_POST["tituloLivro"]) ? $_POST["tituloLivro"] : '');
		$query = "SELECT  titulo, area_conhecimento, autor, Escola.nome FROM Livro JOIN Escola ON Livro.id_escola = Escola.id_escola where ((false)";
		if ($codigo_inicial != ""){
		  if ($codigo_final != "") 	$query=$query."or (Livro.id_livro between :codigo_inicial and :codigo_final)";
		}
		if ($titulo != "") 		$query=$query."or (Livro.titulo like :titulo_pesquisado)";
		$query=$query.");";
		$stmt= $conexao->prepare($query);
		if (!($stmt)) {
		    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		else{
			if (($codigo_inicial != "")&&($codigo_final != "")){
				if (!$stmt->bindParam(":codigo_inicial", $codigo_inicial)) {echo "Erro Campo Codigo incial: (" . $stmt->errno . ") " . $stmt->error;}
				if (!$stmt->bindParam(":codigo_final", $codigo_final)) {echo "Erro Campo Codigo final: (" . $stmt->errno . ") " . $stmt->error;}
			}
			
			//if ($titulo != "") if (!$stmt->bindParam(":titulo_pesquisado", "%{$titulo}%")) {echo "Erro Campo Titulo: (" . $stmt->errno . ") " . $stmt->error;}
			if ($titulo != ""){
				$titulo="%".$titulo."%";
				if (!$stmt->bindParam(":titulo_pesquisado", $titulo)) {echo "Erro Campo Titulo: (" . $stmt->errno . ") " . $stmt->error;}
			}
			$stmt->execute();
			while ($row =$stmt->fetch(PDO::FETCH_ASSOC)) {
				$titulo = $row["titulo"];
				$area_conhecimento = $row["area_conhecimento"];
				$autor = $row["autor"];
				$escola = $row["nome"];
				echo '<div class="boxed">';			
				echo '&nbsp&nbsp&nbsp<b>N.Cham.</b>&nbsp&nbsp&nbsp '  . name_to_cdd($area_conhecimento);
				echo '<p>&nbsp&nbsp Autor: ' . sobrenome_nome($autor) . '</p>';
				echo '<p id="p01">&nbsp&nbsp Título: ' . $titulo . '</p>';
				echo '<center><p id="p02"> Escola ' . $escola . '</p></center>';
				echo '<center><img src="barcode.php?f=png&s=code-128&w=270&ts=5&h=80&pt=0&th=12&d='.$codigos[$i].'"> </center> </div> ';
			}
		}
		$conn->close();
		$conexao=null;
	?>
		
			</div>
		</section>
	</body>
</html>
		  	
