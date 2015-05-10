<?php
	require_once("confBD.php");
	require_once("cidades.php");
	
	class Participante
	{		
		private $arquivoFoto;
		private $cidade;
		private $descricao;
		private $email;
		private $login;	
		private $nomeCompleto;
		private $senha;
		
		public function getArquivoFoto(){
			return $this->arquivoFoto;
		}
		
		public function getIdCidade(){
			return $this->cidade;
		}
		
		public function getDescricao(){
			return $this->descricao;
		}
		
		public function getEmail(){
			return $this->email;
		}
		
		public function getLogin(){
			return $this->login;
		}
		
		public function getNomeCompleto(){
			return $this->nomeCompleto;
		}
	
		public function getSenha(){
			return $this->senha;
		}
		
		public function getCidade()
		{
			$cid = new Cidade();
			return $cid->pesquisaCidadesById($this->cidade);
		}
		
		public function setArquivoFoto($arquivo){
			$this->arquivoFoto=$arquivo;
		}
		
		public function setCidade($cidade){
			$this->cidade=$cidade;
		}
		
		public function setDescricao($descricao){
			$this->descricao=$descricao;
		}
		
		public function setEmail($email){
			$this->email=$email;
		}
		
		public function setLogin($login){
			$this->login=$login;
		}
		
		public function setNomeCompleto($nome){
			$this->nomeCompleto=$nome;
		}
	
		public function setSenha($senha){
			$this->senha=$senha;
		}
		
		public function insereParticipante()
		{
			try
			{													
				if (empty($this->arquivoFoto))
				{
					throw new Exception("Favor informar o arquivo da foto.");
				}
				
				if ($this->cidade<=0)
				{
					throw new Exception("Favor informar a cidade do participante.");
				}
				
				if (empty($this->descricao))
				{
					throw new Exception("Favor informar a descrição do participante.");
				}
				
				if (empty($this->email))
				{
					throw new Exception("Favor informar o email do participante.");
				}
				
				if (empty($this->login))
				{
					throw new Exception("Favor informar o login do participante.");
				}
				
				if (empty($this->nomeCompleto))
				{
					throw new Exception("Favor informar o nome do participante.");
				}
				
				if (empty($this->senha))
				{
					throw new Exception("Favor informar a senha do participante.");
				}
			
				$conBD = conn_mysql();
				
				$instrucao = "INSERT INTO PARTICIPANTES (login, senha, nomeCompleto, arquivoFoto, cidade, email, descricao)";
				$instrucao = $instrucao . " VALUES (:plog, MD5(:psenha), :pnome, :pfoto, :pcidade, :pemail, :pdescricao);";
				
				$sql = $conBD->prepare($instrucao);
				
				$sql->bindParam(":plog",$this->login);
				$sql->bindParam(":psenha",$this->senha);
				$sql->bindParam(":pnome",$this->nomeCompleto);
				$sql->bindParam(":pfoto",$this->arquivoFoto);
				$sql->bindParam(":pcidade",$this->cidade);
				$sql->bindParam(":pemail",$this->email);
				$sql->bindParam(":pdescricao",$this->descricao);
				
				$inserir = $sql->execute();
				
				$conBD = null;
				
				if ($inserir)
				{
					return $inserir;
				}
				else
				{
					$arr = $sql->errorInfo();		//mensagem de erro retornada pelo SGBD
					$erro = utf8_decode($arr[2]);
					throw new Exception($erro);
				}							
			}
			catch (Exception $e)
			{
				throw new Exception("Erro ao cadastrar participantes.".$e->getMessage());				
			}
		}
		
		public function alteraParticipante()
		{
			try
			{													
				if (empty($this->arquivoFoto))
				{
					throw new Exception("Favor informar o arquivo da foto.");
				}
				
				if ($this->cidade<=0)
				{
					throw new Exception("Favor informar a cidade do participante.");
				}
				
				if (empty($this->descricao))
				{
					throw new Exception("Favor informar a descrição do participante.");
				}
				
				if (empty($this->email))
				{
					throw new Exception("Favor informar o email do participante.");
				}
				
				if (empty($this->login))
				{
					throw new Exception("Favor informar o login do participante.");
				}
				
				if (empty($this->nomeCompleto))
				{
					throw new Exception("Favor informar o nome do participante.");
				}
				
				if (empty($this->senha))
				{
					throw new Exception("Favor informar a senha do participante.");
				}
			
				$conBD = conn_mysql();
				
				$instrucao = "UPDATE PARTICIPANTES";
				$instrucao = $instrucao . " SET senha=MD5(:psenha), nomeCompleto=:pnome, arquivoFoto=:pfoto, cidade=:pcidade, email=:pemail, descricao=:pdescricao";
				$instrucao = $instrucao . " WHERE login=:plog ";
				
				$sql = $conBD->prepare($instrucao);
				
				$sql->bindParam(":plog",$this->login);
				$sql->bindParam(":psenha",$this->senha);
				$sql->bindParam(":pnome",$this->nomeCompleto);
				$sql->bindParam(":pfoto",$this->arquivoFoto);
				$sql->bindParam(":pcidade",$this->cidade);
				$sql->bindParam(":pemail",$this->email);
				$sql->bindParam(":pdescricao",$this->descricao);
				
				$alterar = $sql->execute();
				
				$conBD = null;
				
				if ($alterar)
				{
					return $alterar;
				}
				else
				{
					$arr = $sql->errorInfo();		//mensagem de erro retornada pelo SGBD
					$erro = utf8_decode($arr[2]);
					throw new Exception($erro);
				}
			}
			catch (Exception $e)
			{
				throw new Exception("Erro ao alterar participantes.".$e->getMessage());
			}
		}
		
		public function excluiParticipante()
		{
			try
			{																				
				if (empty($this->login))
				{
					throw new Exception("Favor informar o login do participante.");
				}							
			
				$conBD = conn_mysql();
				
				$instrucao = "DELETE FROM PARTICIPANTES";				
				$instrucao = $instrucao . " WHERE login=:plog ";
				
				$sql = $conBD->prepare($instrucao);
				
				$sql->bindParam(":plog",$this->login);				
				
				$alterar = $sql->execute();
				
				$conBD = null;
				
				if ($alterar)
				{
					return $alterar;
				}
				else
				{
					$arr = $sql->errorInfo();		//mensagem de erro retornada pelo SGBD
					$erro = utf8_decode($arr[2]);
					throw new Exception($erro);
				}
			}
			catch (Exception $e)
			{
				throw new Exception("Erro ao alterar participantes.".$e->getMessage());
			}
		}
		
		
		
		public function pesquisaParticipantesByLogin($login){
			try
			{
				if (empty($login))
				{
					throw new Exception("Favor informar o login para realizar a pesquisa.");
				}
			
				// instancia objeto PDO, conectando no mysql
				$conBD = conn_mysql();
				
				$select = "select * from participantes where login=:plogin";
				
				//prepara a execução da consulta
				$operacao = $conBD->prepare($select);
				$operacao->bindParam(":plogin",$login);				
								
				$pesquisar = $operacao->execute();
				
				$resultados = $operacao->fetchAll();
				
				$conBD = null;				
				
				if (count($resultados)>0)
				{					
					$part = new Participante();
					$part->arquivoFoto = $resultados[0]["arquivoFoto"];
					$part->cidade = $resultados[0]["cidade"];
					$part->descricao = $resultados[0]["descricao"];
					$part->email = $resultados[0]["email"];
					$part->login = $resultados[0]["login"];
					$part->nomeCompleto = $resultados[0]["nomeCompleto"];
					$part->senha = "";
																				
					return $part;
				}
				else
				{
					return null;
				}
			}
			catch(Exception $e)
			{
				echo "<p>Erro ao pesquisar participantes.".$e->getMessage()."</p>";
				die();
			}
			
		}
				
		
		public function pesquisaParticipantesByLoginSenha($login, $senha){
			try
			{
				if (empty($login))
				{
					throw new Exception("Favor informar o login para realizar a pesquisa.");
				}
			
				// instancia objeto PDO, conectando no mysql
				$conBD = conn_mysql();
				
				$select = "select * from participantes where login=:plogin and senha=MD5(:psenha)";
				
				//prepara a execução da consulta
				$operacao = $conBD->prepare($select);
				$operacao->bindParam(":plogin",$login);
				$operacao->bindParam(":psenha",$senha);
								
				$pesquisar = $operacao->execute();
				
				$resultados = $operacao->fetchAll();
				
				$conBD = null;				
				
				if (count($resultados)>0)
				{					
					$part = new Participante();
					$part->arquivoFoto = $resultados[0]["arquivoFoto"];
					$part->cidade = $resultados[0]["cidade"];
					$part->descricao = $resultados[0]["descricao"];
					$part->email = $resultados[0]["email"];
					$part->login = $resultados[0]["login"];
					$part->nomeCompleto = $resultados[0]["nomeCompleto"];
					$part->senha = "";
																				
					return $part;
				}
				else
				{
					return null;
				}
			}
			catch(Exception $e)
			{
				echo "<p>Erro ao pesquisar participantes.".$e->getMessage()."</p>";
				die();
			}
			
		}
		
		public function pesquisaTodosParticipantesByNome($nome)
		{
			try
			{
				// instancia objeto PDO, conectando no mysql
				$conBD = conn_mysql();
				
				$select = "select * from participantes where nomeCompleto like :nome order by nomeCompleto";
				
				//prepara a execução da consulta
				$operacao = $conBD->prepare($select);
				$param = "%".$nome."%";
				$operacao->bindParam(":nome",$param);
				
				$pesquisar = $operacao->execute();
				
				$resultados = $operacao->fetchAll();
				
				$conBD = null;
				$partipantesCadastrados = array();
				
				if (count($resultados)>0)
				{
					for ($i = 0; $i <= count($resultados) - 1; $i++)
					{
						$part = new Participante();
						$part->arquivoFoto = $resultados[$i]["arquivoFoto"];
						$part->cidade = $resultados[$i]["cidade"];
						$part->descricao = $resultados[$i]["descricao"];
						$part->email = $resultados[$i]["email"];
						$part->login = $resultados[$i]["login"];
						$part->nomeCompleto = $resultados[$i]["nomeCompleto"];
						$part->senha = "";
						
						$partipantesCadastrados[$i]=$part;
					}
					
					return $partipantesCadastrados;
				}
				else
				{
					return array();
				}
			}
			catch(Exception $e)
			{
				echo "<p>Erro ao pesquisar participantes.".$e->getMessage()."</p>";
				die();
			}
			
		}
		
		public function pesquisaTodosParticipantes(){
			try
			{
				// instancia objeto PDO, conectando no mysql
				$conBD = conn_mysql();
				
				$select = "select * from participantes order by nomeCompleto";
				
				//prepara a execução da consulta
				$operacao = $conBD->prepare($select);
				
				$pesquisar = $operacao->execute();
				
				$resultados = $operacao->fetchAll();
				
				$conBD = null;
				$partipantesCadastrados = array();
				
				if (count($resultados)>0)
				{
					for ($i = 0; $i <= count($resultados) - 1; $i++)
					{
						$part = new Participante();
						$part->arquivoFoto = $resultados[$i]["arquivoFoto"];
						$part->cidade = $resultados[$i]["cidade"];
						$part->descricao = $resultados[$i]["descricao"];
						$part->email = $resultados[$i]["email"];
						$part->login = $resultados[$i]["login"];
						$part->nomeCompleto = $resultados[$i]["nomeCompleto"];
						$part->senha = "";
						
						$partipantesCadastrados[$i]=$part;
					}
					
					return $partipantesCadastrados;
				}
				else
				{
					return array();
				}
			}
			catch(Exception $e)
			{
				echo "<p>Erro ao pesquisar participantes.".$e->getMessage()."</p>";
				die();
			}
			
		}
		
	}
?>