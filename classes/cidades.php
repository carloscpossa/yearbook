<?php
	require_once("confBD.php");
	require_once("estados.php");
	
	class Cidade
	{
		public $idEstado;
		public $idCidade;
		public $nomeCidade;
	
		public function getIdEstado()
		{
			return $this->idEstado;
		}
	
		public function getIdCidade()
		{
			return $this->idCidade;
		}
	
		public function getNomeCidade()
		{
			return $this->nomeCidade;
		}
		
		public function getEstado()
		{			
			$est = new Estado();
			return $est->pesquisaEstadoById($this->idEstado);
		}
		
		public function pesquisaCidadesEstado($estado)
		{
			try
			{
				if ($estado==null)
				{
					throw new Exception ("Favor informar o estado para pesquisa das cidades.");
				}
			
				if (!$estado instanceof Estado)
				{
					throw new Exception ("Favor informar o estado para pesquisa das cidades.");
				}
			
				$conBD = conn_mysql();
				
				$select = "SELECT * FROM cidades where idEstado=:idEst order by nomeCidade";
				
				$sql = $conBD->prepare($select);
				
				$sql->bindParam(":idEst", $estado->getIdEstado());
				
				$pesquisar = $sql->execute();
				
				$resultados = $sql->fetchAll();
				
				$conBD = null;
				
				$cidades = array();
				if (count($resultados)>0)
				{
					for ($i = 0; $i <= count($resultados) - 1; $i++)
					{
						$cid = new Cidade();
						/*$cid->idEstado = utf8_encode($resultados[$i]["idEstado"]);
						$cid->idCidade = utf8_encode($resultados[$i]["idCidade"]);
						$cid->nomeCidade = utf8_encode($resultados[$i]["nomeCidade"]);*/
						
						$cid->idEstado = $resultados[$i]["idEstado"];
						$cid->idCidade = $resultados[$i]["idCidade"];
						$cid->nomeCidade = $resultados[$i]["nomeCidade"];
						
						$cidades[$i] = $cid;
					}
				}
				
				return $cidades;
			}
			catch (Exception $e)
			{
				echo "<p>Erro ao pesquisar cidades.".$e->getMessage()."</p>";				
				die();
			}
		}
	
		public function pesquisaCidadesById($idCid)
		{
			try
			{													
				$conBD = conn_mysql();
				
				$select = "SELECT * FROM cidades where idCidade=:pidCidade";
				
				$sql = $conBD->prepare($select);
				
				$sql->bindParam(":pidCidade", $idCid);
				
				$pesquisar = $sql->execute();
				
				$resultados = $sql->fetchAll();
				
				$conBD = null;
								
				if (count($resultados)>0)
				{
					$cid = new Cidade();
					/*$cid->idEstado = utf8_encode($resultados[0]["idEstado"]);
					$cid->idCidade = utf8_encode($resultados[0]["idCidade"]);
					$cid->nomeCidade = utf8_encode($resultados[0]["nomeCidade"]);*/
					
					$cid->idEstado = $resultados[0]["idEstado"];
					$cid->idCidade = $resultados[0]["idCidade"];
					$cid->nomeCidade = $resultados[0]["nomeCidade"];
					
					
					return $cid;
				}
				else
				{
					return null;
				}
				
			}
			catch (Exception $e)
			{
				echo "<p>Erro ao pesquisar cidades.".$e->getMessage()."</p>";				
				die();
			}
		}
	
	}
	
?>