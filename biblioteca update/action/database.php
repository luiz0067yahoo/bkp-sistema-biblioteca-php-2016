<?php


	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "biblioteca";
			

	// Create connection
	global $conn;
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
			
	$conn->set_charset("utf8");

	$conexao = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
