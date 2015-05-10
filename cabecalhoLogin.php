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
    </head>
    <body>
        <header> <!-- seção para separar o título -->
            <h1>Especialização em Desenvolvimento de Sistemas para Web - 2014</h1>
            <p>PUC MINAS</p>
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
        