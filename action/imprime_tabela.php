<!DOCTYPE html>
<html>
<head>
	<title>Impressao</title>
	<style type="text/css">
		table {
    		border-collapse: collapse;
		}

		table, th, td {
    		border: 1px solid black;
		}
	</style>
</head>
<body>
	<?php
	session_start();
	echo $_SESSION["cabecalho"];
	echo "<br><br>";
    echo $_SESSION["tabela"];
	?>

	<script type="text/javascript">window.print()</script>
	<script type="text/javascript">window.close()</script>
</body>
</html>