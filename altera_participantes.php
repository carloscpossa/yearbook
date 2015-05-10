<?php
	session_start();

	if (isset($_SESSION["logged"]) && isset($_SESSION["login"]) && $_SESSION["logged"])
	{
		include_once("cabecalhoParticipante.html");	
		require_once("classes/participantes.php");		
				
		$nome = htmlspecialchars($_POST["nomecompleto"]);
		$email = htmlspecialchars($_POST["email"]);		
		$senha = htmlspecialchars($_POST["senhapart"]);
		$descricao = htmlspecialchars($_POST["descricaopart"]);
		$cidade = htmlspecialchars($_POST["cbcidadepart"]);	
		
		$termina_execucao = false;
		
		if (empty($nome))
		{
			echo "<h2>Favor preencher o nome do participante.</h2>";
			$termina_execucao = true;
		}
		
		if (empty($email))
		{
			echo "<h2>Favor preencher o e-mail do participante.</h2>";
			$termina_execucao = true;
		}
		
		if (empty($_SESSION["login"]))
		{
			echo "<h2>Favor preencher o login do participante.</h2>";
			$termina_execucao = true;
		}
		
		if (empty($senha))
		{
			echo "<h2>Favor preencher a senha do participante.</h2>";
			$termina_execucao = true;
		}
		
		if (empty($descricao))
		{
			echo "<h2>Favor preencher a descricao do participante.</h2>";
			$termina_execucao = true;
		}
		
		if (empty($cidade))
		{
			echo "<h2>Favor preencher a cidade do participante.</h2>";
			$termina_execucao = true;
		}
		
		$permissoes = array("gif", "jpeg", "jpg", "png", "image/gif", "image/jpeg", "image/jpg", "image/png");  //strings de tipos e extensoes validas
		$temp = explode(".", basename($_FILES["fotopart"]["name"]));
		$extensao = end($temp);
		
		if ((in_array($extensao, $permissoes))
			&& (in_array($_FILES["fotopart"]["type"], $permissoes))
			&& ($_FILES["fotopart"]["size"] < $_POST["MAX_FILE_SIZE"]))
			  {
			  if ($_FILES["fotopart"]["error"] > 0)
			  {
				echo "<h2>Erro no envio, código: " . $_FILES["fotopart"]["error"] . "</h2>";
				$termina_execucao = true;
			  }
			  else
				{
				  $dirUploads = "imagens/";
				  $nomeUsuario = $_SESSION["login"]."/";	  
				  
				  if(!file_exists ( $dirUploads ))
						mkdir($dirUploads, 0500);  //permissao de leitura e execucao
				  
				  $caminhoUpload = $dirUploads.$nomeUsuario;
				  if(!file_exists ( $caminhoUpload ))
						mkdir($caminhoUpload, 0700);  //permissoes de escrita, leitura e execucao
						
				  $pathCompleto = $caminhoUpload.basename($_FILES["fotopart"]["name"]);
				  if(!move_uploaded_file($_FILES["fotopart"]["tmp_name"], $pathCompleto))
				  {
					 echo "<h2>Problemas ao armazenar o arquivo. Tente novamente.<h2>";
					 $termina_execucao = true;
				  }			  
				}
			  }
			else
			{
			  echo "<h2>Arquivo inválido. Favor verificar o tamanho do arquivo.<h2>";
			  $termina_execucao = true;
			}		
		
			if ($termina_execucao)
			{
				echo "<a href=\"cadastroParticipante.php\">Voltar</a>";
				echo "</body>";
				include_once("rodape.html");
				die();
			}
		
			try
			{
				$part = new Participante();
				$part->setArquivoFoto($pathCompleto);
				$part->setCidade($cidade);
				$part->setDescricao($descricao);
				$part->setEmail($email);
				$part->setLogin($_SESSION["login"]);
				$part->setNomeCompleto($nome);
				$part->setSenha($senha);
				$inseriu = $part->alteraParticipante();
				
				if ($inseriu)
				{
					echo "<h2>Participante alterado com sucesso.<h2>";
					echo "<a href=\"principal.php\">Voltar</a>";
				}
				else
				{
					echo "<h2>Erro.<h2>";
				}
			}
			catch (Exception $e)
			{
				echo "<h2>Erro ao alterar participante. ".$e->getMessage()."</h2>";
				echo "<a href=\"principal.php\">Voltar</a>";
			}
			echo "</body>";	
			include_once("rodape.html");
	}
	else
	{
		echo "<h2>Favor realizar o login no sistema.</h2>";
		echo "<a href=\"index.php\">Voltar</a>";
		die();
	}	
?>