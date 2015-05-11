<?php
	$login = "";
	if(isset($_COOKIE["lembrar_login"])){
		$login = $_COOKIE["lembrar_login"];
   }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" lang="pt-br" />
        <title>Yearbook - Desenvolvimento de Aplicações Web - PUC 2014</title>
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
			<header> <!-- seção para separar o título -->
				<div class="page-header">
					<h1>Especialização em Desenvolvimento de Sistemas para Web - 2014</h1>
					<p>PUC MINAS</p>
				</div>
			</header>
			<section> <!-- seção com as fotos e formulário de login-->
				<div id="login">
					<form lang="pt-br" method="post" action="login.php">                    
						<div>
							<label for="User">Usuário:</label>
							<?php
								echo "<input id=\"User\" type=\"text\" placeholder=\"Digite o usuário\" name=\"usuario\" value=\"".$login."\" />"
							?>
						</div>
						<div>
							<label for="Pass">Senha:</label>
							<input id="Pass" type="password" placeholder="Digite a senha" name="passwd" />
						</div>
						<div>
							<label>
								<?php
									if (empty($login))
									{								
										echo "<input type=\"checkbox\" name=\"lembrar[0]\" value=\"lembrar_login\" />Lembrar-me.";
									}
									else
									{
										echo "<input type=\"checkbox\" name=\"lembrar[0]\" value=\"lembrar_login\" checked/>Lembrar-me.";
									}
								?>
							</label>
							<label id="cadastro"><a href="cadastroParticipante.php">Cadastre-se</a></label>
							<button type="submit">Entrar</button>
						</div>                                        
					</form>
				</div>
        