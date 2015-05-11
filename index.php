<?php	
	
	include_once("cabecalhoLogin.php");
	include_once("./classes/participantes.php");
	
	$part = new Participante();
	
	$participantesCadastrados = $part->pesquisaTodosParticipantes();
	
	if (count($participantesCadastrados)==0)
	{
		echo "<p>Não há participantes cadastrados no yearbook.</p>";
	}
	else
	{			
		$controle = 1;
		for ($i = 0; $i <= count($participantesCadastrados) - 1; $i++)
		{
			if ($controle == 1)
			{
				echo "<div class=\"row\" >";
				echo "<ul>";		
			}
			
			$part = $participantesCadastrados[$i];
			
			echo "<div class=\"col-sm-6 col-md-3\" >";
			echo "<li>";
			echo "<a class=\"thumbnail\" href=\"dadosparticipante.php?loginpart=".$part->getLogin()."\" >";			
			echo "<figure>";
			echo "<img src=\"".$part->getArquivoFoto()."\" alt=\"".$part->getNomeCompleto()."\" title=\"".$part->getNomeCompleto()."\" width=\"240\" height=\"320\" />";
			echo "<figcaption>".$part->getNomeCompleto()."</figcaption></figure></a></li>";
			echo "</div>";
                         														
                   
			$controle++;
			
			if ($controle==5 | count($participantesCadastrados)<4 | $i == count($participantesCadastrados) - 1)
			{
				echo "</ul>";
				echo "</div>";
				$controle = 1;
			}
		
		}
	}
	
	include_once("rodape.html");

?>
