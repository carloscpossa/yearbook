<?php
	session_start();	
	
	if (isset($_SESSION["logged"]) && isset($_SESSION["login"]) && $_SESSION["logged"] && isset($_GET["loginpart"]))
	{
		$loginpart = $_GET["loginpart"];
		if (empty($loginpart))
		{
			header("Location: ./principal.php");
		}
		else
		{
			require_once("classes/participantes.php");
			
			$part = new Participante();
			$part = $part->pesquisaParticipantesByLogin($loginpart);
			
			if ($part==null)
			{
				echo "<h2>Participante não encontrado.</h2>";
				echo "<a href=\"principal.php\">Voltar</a>";
				die();
			}
			else
			{
				$validadeCookie = mktime(0,0,0,12,31,2025);
				setcookie("ultimo_perfil_visitado", $part->getLogin(), $validadeCookie);
				setcookie("perfil_visita", $_SESSION["login"], $validadeCookie);							
			}
		}
	}
	else
	{
		echo "<h2>Favor realizar o login no sistema.</h2>";
		echo "<a href=\"index.php\">Voltar</a>";
		die();
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta lang="pt-br" charset="utf-8" />
		<?php
			echo "<title>".$part->getNomeCompleto()." - Desenvolvimento de Sistemas para a Web</title>";
		?>
        <link rel="stylesheet" href="estilos/estilo.css" />
    </head>
    <body>
        <header>
			<?php
				echo "<h1>".$part->getNomeCompleto()."</h1>";
			?>	
            <p>Especialização em Desenvolvimento de Sistemas para Web</p>
        </header>		
        <section id="foto">
            <figure>
				<?php
					echo "<img src=\"".$part->getArquivoFoto()."\" alt=\"".$part->getNomeCompleto()."\" title=\"".$part->getNomeCompleto()."\" width=\"240\" height=\"320\" />";
				?>
            </figure>
        </section>
        <section>
            <dl>
				<?php
					echo "<dt>Nome Completo</dt>";				
					echo "<dd>".$part->getNomeCompleto()."</dd>";
					echo "<dt>Cidade</dt>";
					echo "<dd>".$part->getCidade()->getNomeCidade().", ".$part->getCidade()->getEstado()->getSiglaEstado().".</dd>";
					echo "<dt>E-mail</dt>";
					echo "<dd>".$part->getEmail()."</dd>";
					echo "<dt>Descrição</dt>";
					echo "<dd>".$part->getDescricao()."</dd>";
					
					echo "<a href=\"principal.php\">Voltar ao início.</a>";
				?>
            </dl>			
        </section>
        <footer>
            <small>Autor: Carlos Henrique Coimbra Possa - 2014</small>
        </footer>
    </body>
</html>