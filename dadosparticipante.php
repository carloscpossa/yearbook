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
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">        

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
		<div class="container">
			<header>
				<div class="page-header">
					<?php
						echo "<h1>".$part->getNomeCompleto()."</h1>";
					?>	
					<p>Especialização em Desenvolvimento de Sistemas para Web</p>
				</div>
			</header>		
			<section id="foto">
				<figure class="text-center">
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
						echo "<dd class=\"text-justify\">".$part->getDescricao()."</dd>";											
					?>
				</dl>
				<?php
					echo "<a href=\"index.php\">Voltar ao início.</a>";
				?>	
			</section>
			<footer>
				<small class="text-center">Autor: Carlos Henrique Coimbra Possa - 2014</small>
			</footer>
			<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
			<!-- Include all compiled plugins (below), or include individual files as needed -->
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		</div>
    </body>
</html>