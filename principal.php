<?php
	session_start();
	
	if (isset($_SESSION["logged"]) && isset($_SESSION["login"]) && $_SESSION["logged"])
	{
		require_once("classes/participantes.php");
		include_once("cabecalho.html");
		
		if (empty($_SESSION["login"]))
		{
			echo "<h2>Favor realizar o login no sistema.</h2>";
			echo "<a href=\"index.php\">Voltar</a>";
			die();
		}
		
		$part = new Participante();	
	
		$part = $part->pesquisaParticipantesByLogin($_SESSION["login"]);
		
		echo "<div>";		
		echo "<div><figure id=\"fotousuario\">";
		echo "<img src=\"".$part->getArquivoFoto()."\" alt=\"".$part->getNomeCompleto()."\" title=\"".$part->getNomeCompleto()."\" width=\"120\" height=\"160\" />";
		//echo "<figcaption>".$part->getNomeCompleto()."</figcaption></figure>";
		echo "</figure>";
		
		/*echo "<p>Participante: ".$part->getNomeCompleto()."</p>";
		echo "<p>E-mail: ".$part->getEmail()."</p>";
		echo "<p>Cidade: ".$part->getCidade()->getNomeCidade()." - ".$part->getCidade()->getEstado()->getSiglaEstado()."</p>";
		echo "<p>Descrição: ".$part->getDescricao()."</p>";*/
		
		echo "<dl>";
		echo "<dt>Nome Completo</dt>";
		echo "<dd>".$part->getNomeCompleto()."</dd>";
		echo "<dt>Cidade</dt>";
		echo "<dd>".$part->getCidade()->getNomeCidade().", ".$part->getCidade()->getEstado()->getSiglaEstado()."</dd>";
		echo "<dt>E-mail</dt>";
		echo "<dd>".$part->getEmail()."</dd>";
		echo "<dt>Descrição</dt>";
		echo "<dd>".$part->getDescricao()."</dd>";
		echo "</dl>";							
		echo "</div>";
		
		echo "</div>";
		
		
		echo "<div id=\"buscapornome\">";
		echo "<form role=\"form\" method=\"post\" action=\"buscapornome.php\" >";
		echo "<div><label for=\"busca\">Pesquisa de participantes<label></div>";
		if (isset($_SESSION["nomebusca"]) && !empty($_SESSION["nomebusca"]))
		{
			echo "<input type=\"text\" id=\"busca\" name=\"busca\" placeholder=\"Digite o nome para pesquisar participantes.\" value=\"".$_SESSION["nomebusca"]."\">"; 
		}
		else
		{
			echo "<input type=\"text\" id=\"busca\" name=\"busca\" placeholder=\"Digite o nome para pesquisar participantes.\">"; 
		}
		echo "<button type=\"submit\">Pesquisar</button>";
		
		$login_visita = "";
		if(isset($_COOKIE["perfil_visita"]) && isset($_COOKIE["ultimo_perfil_visitado"]))
		{
			$login_visita = $_COOKIE["perfil_visita"];
			$ultimoperfil = $_COOKIE["ultimo_perfil_visitado"];
			if (($login_visita == $_SESSION["login"]) && (!empty($ultimoperfil)))
			{
			
				$perf = new Participante();
				$perf = $perf->pesquisaParticipantesByLogin($ultimoperfil);
				
				if ($perf!=null)
				{
					echo "<label>Último perfil visitado:<a href=\"dadosparticipante.php?loginpart=".$perf->getLogin()."\" >".$perf->getNomeCompleto()."</label>";
				}
			}
		}
		
		echo "</form>";
		echo "</div>";
		
		
		$part2 = new Participante();	
		
		/*if (isset($_SESSION["nomebusca"]) && !empty($_SESSION["nomebusca"]))
		{
			$participantesCadastrados = $part2->pesquisaTodosParticipantesByNome($_SESSION["nomebusca"]);
		}
		else
		{
			$participantesCadastrados = $part2->pesquisaTodosParticipantes();
		}*/
		
		$participantesCadastrados = $part2->pesquisaTodosParticipantes();
				
		$controle = 1;
		for ($i = 0; $i <= count($participantesCadastrados) - 1; $i++)
		{
			$part2 = $participantesCadastrados[$i];
			if ($part->getLogin()!=$part2->getLogin())
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