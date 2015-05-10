<?php
	session_start();
	
	if (isset($_SESSION["logged"]) && isset($_SESSION["login"]) && $_SESSION["logged"] && !empty($_SESSION["login"]))
	{	
		require_once("classes/participantes.php");
		include_once("cabecalho.html");	
		
		$part2 = new Participante();
		
		$participantesCadastrados = $part2->pesquisaTodosParticipantesByNome(htmlspecialchars($_POST["busca"]));
				
		echo "<h2>Pesquisa de Participantes:</h2>";
		echo "<p>Filtro utilizado na consulta por nome: ".htmlspecialchars($_POST["busca"])."</p>";
				
		$controle = 1;
		for ($i = 0; $i <= count($participantesCadastrados) - 1; $i++)
		{
			$part2 = $participantesCadastrados[$i];
			if ($_SESSION["login"]!=$part2->getLogin())
			{
				if ($controle == 1)
				{
					echo "<div class=\"fotos\" >";
					echo "<ul>";		
				}
														
				echo "<li>";
				echo "<a href=\"dadosparticipante.php?loginpart=".$part2->getLogin()."\" >";
				echo "<figure>";
				echo "<img src=\"".$part2->getArquivoFoto()."\" alt=\"".$part2->getNomeCompleto()."\" title=\"".$part2->getNomeCompleto()."\" width=\"240\" height=\"320\" />";
				echo "<figcaption>".$part2->getNomeCompleto()."</figcaption></figure></a></li>";
										
				$controle++;
					
				if ($controle==5 | count($participantesCadastrados)<4)
				{
					echo "</ul>";
					echo "</div>";
					$controle = 1;
				}
			}		
		}
		
		
		include_once("rodape.html");
	}
	else
	{
		echo "<h2>Favor realizar o login no sistema.</h2>";
		echo "<a href=\"index.php\">Voltar</a>";
	}
?>