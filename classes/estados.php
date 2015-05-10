<?php
	require_once("confBD.php");
	class Estado
	{
		private $idEstado;
		private $nomeEstado;
		private $siglaEstado;
		
		public function getIdEstado()
		{
			return $this->idEstado;		
		}
		
		public function getNomeEstado()
		{
			return $this->nomeEstado;
		}
		
		public function getSiglaEstado()
		{
			return $this->siglaEstado;
		}
		
		public function pesquisaEstados()
		{
			try
			{
				$conBD = conn_mysql();
				
				$select = "select * from estados order by sigaEstado";
				
				$operacao = $conBD->prepare($select);
				
				$operacao->execute();
				
				$resultados = $operacao->fetchAll();
				
				$conBD = null;
				
				$estados = array();
																		
					for ($i = 0; $i<=count($resultados)-1; $i++)
					{
						$est = new Estado();
						$est->idEstado = utf8_encode($resultados[$i]["idEstado"]);
						$est->nomeEstado = utf8_encode($resultados[$i]["nomeEstado"]);
						$est->siglaEstado = utf8_encode($resultados[$i]["sigaEstado"]);
						
						$estados[$i]=$est;
					}
				
				
				
				return $estados;
			}
			catch (Exception $e)
			{
				echo "<p>Erro ao pesquisar estados.".$e->getMessage()."</p>";				
				die();
			}
		}
		
		
	
		public function pesquisaEstadoById($idEst)
		{
			try
			{
				$conBD = conn_mysql();
				
				$select = "select * from estados where idEstado=:pid";
				
				$operacao = $conBD->prepare($select);
				$operacao->bindParam(":pid", $idEst);
				
				$pesquisar = $operacao->execute();
				
				$resultados = $operacao->fetchAll();
				
				$conBD = null;						
				
				if (count($resultados)>0)
				{
					$est = new Estado();
					$est->idEstado = utf8_encode($resultados[0]["idEstado"]);
					$est->nomeEstado = utf8_encode($resultados[0]["nomeEstado"]);
					$est->siglaEstado = utf8_encode($resultados[0]["sigaEstado"]);
					return $est;
				}
				else
				{
					return null;
				}
			}
			catch (Exception $e)
			{
				echo "<p>Erro ao pesquisar estados.".$e->getMessage()."</p>";				
				die();
			}
		}
	
	}
?>