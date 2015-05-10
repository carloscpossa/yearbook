<?php
	session_start();

	require_once("classes/participantes.php");		
					
	$login = htmlspecialchars($_POST["usuario"]);
	$senha = htmlspecialchars($_POST["passwd"]);	
	
	//Verificando se o usuário existe
	$part = new Participante();	
	
	$part = $part->pesquisaParticipantesByLoginSenha($login, $senha);
	
	if ($part==null)
	{
		echo "<h2>Usuário ou senha incorretos.</h2>";
		echo "<a href=\"index.php\">Voltar</a>";
		die();
	}	
	
	
	$lembrar = array();
	$lembrarLogin = "";
	if(count($_POST["lembrar"])>0){				//verifica se o cliente marcou pelo menos uma área.
		foreach($_POST["lembrar"] as $valor)
		{
			$lembrarLogin = $valor;			
		}
	}
	
	if ($lembrarLogin=="lembrar_login")
	{
		$validadeCookie = mktime(0, 0, 0, 12, 31, 2025);
		setcookie("lembrar_login", $login, $validadeCookie);
	}
	
	$_SESSION["login"]=$login;
	$_SESSION["logged"]=true;
	
	header("Location: principal.php");
?>