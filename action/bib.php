<?php 

function sobrenome_nome($string)
{
	$numero_espacos = 0;
	if ($string[strlen($string) - 1] == ' ')
		$string[strlen($string) - 1] = '';
	for ($i = 0; $i < strlen($string); $i++)
	{
		if ($string[$i] == ' ')
			$numero_espacos++;
	}

	if($numero_espacos == 0)
		return strtoupper($string);
	$sobrenome = "";
	$nome = "";
	$numero_espacos_confere = 0;
	for ($i = 0; $i < strlen($string); $i++)
	{
		if ($numero_espacos == $numero_espacos_confere)
			$sobrenome .= $string[$i];
		else if ($numero_espacos_confere < $numero_espacos)
			$nome .= $string[$i];
		else if ($numero_espacos_confere > $numero_espacos)
			die("Error function sobrenome_nome");
		if ($string[$i] == ' ')
			$numero_espacos_confere++;

		


	}

	return strtoupper($sobrenome) . ", " . $nome;
}



?>