<?php
	session_start();
	
	if (isset($_SESSION["logged"]) && isset($_SESSION["login"]) && $_SESSION["logged"])
	{	
		require_once("classes/participantes.php");
		try
		{
			$part = new Participante();
			$part->setLogin($_SESSION["login"]);
			$part->excluiParticipante();				
		
			echo "<h2>Participante excluído com sucesso.</h2>";
			
			$_SESSION = array();  //Limpa o vetor de sessão
	
			if (ini_get("session.use_cookies")) //verifica se a sessão usa cookies
			{					
				$params = session_get_cookie_params();				//carrega todos os parâmetros do cookie da sessão
				setcookie(session_name(), '', time() - 42000,		//configura um cookie exatamente igual para 42000seg (700h) atrás
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
}
			session_destroy();		// Destruímos a sessão em si
						
			echo "<a href=\"index.php\">Voltar</a>";			
		}
		catch (Exception $e)
		{
			echo "<h2>".$e->getMessage()."</h2>";
			echo "<a href=\"principal.php\">Voltar</a>";
		}
	}
	else
	{
		echo "<h2>Favor realizar o login no sistema.</h2>";
		echo "<a href=\"index.php\">Voltar</a>";
	}
?>