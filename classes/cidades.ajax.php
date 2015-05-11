<?php	
	
		
	require_once("cidades.php");
	require_once("estados.php");
	
	//$cod_estados = mysql_real_escape_string( $_REQUEST['cod_estados'] );	
	
	$cod_estados = $_REQUEST['cod_estados'];	
	
	//$cod_estados = 11;
	$est = new Estado();
	$est = $est->pesquisaEstadoById($cod_estados);
	
	$cid = new Cidade();
	
	$cidades = $cid->pesquisaCidadesEstado($est);	
	
	echo( json_encode( $cidades ) );
	