<?php
	session_start();

	if (isset($_SESSION["logged"]) && isset($_SESSION["login"]) && $_SESSION["logged"])
	{
		require_once("classes/participantes.php");		
		$part = new Participante();		
		$part = $part->pesquisaParticipantesByLogin($_SESSION["login"]);		
	}
	else
	{
		echo "<h2>Favor realizar o login no sistema.</h2>";
		echo "<a href=\"index.php\">Voltar</a>";
		die();
	}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" lang="pt-br" />
        <title>Yearbook DAW - Alteração de Participante - PUC 2014</title>
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
					<h1>Alteração de Participante</h1>
					<p>Yearbook - Especialização em Desenvolvimento de Sistemas para Web - PUC MINAS 2014</p>
				</div>
			</header>
			<nav>
				<ul>                
					<li><a href="principal.php">Início</a></li>
					<li><a href="cadastroParticipante.php">Cadastrar Participante</a></li>
					<li><a href="alteraParticipante.php">Alterar Participante</a></li>
					<li><a href="exclui_participante.php">Excluir Participante</a></li>
					<li><a href="logout.php">Sair</a></li>
				</ul>
			</nav>
			<section>
				<div class="cadastro">
					<form id="fparticipante" role="form" method="post" action="altera_participantes.php" enctype="multipart/form-data">                                    
						<input type="hidden" name="MAX_FILE_SIZE" value="1500000" >
						<fieldset>
							<legend>Dados do Participante</legend>						
							<div>
								<label for="nome">Nome do Participante</label>
							</div>
							<div>
								<?php
									echo "<input type=\"text\" id=\"nome\" name=\"nomecompleto\" maxlength=\"50\" placeholder=\"Informar o nome completo\" value=\"".$part->getNomeCompleto()."\" />";
								?>
							</div>
							<div>
								<label for="email">E-mail do Participante</label>
							</div>
							<div>
								<?php
									echo "<input type=\"email\" id=\"email\" name=\"email\" maxlength=\"50\" placeholder=\"Informar o e-mail\" value=\"".$part->getEmail()."\" />";
								?>
							</div>						
							<div>
								<label for="txtsenha">Senha do Participante</label>
							</div>
							<div>
								<?php
									echo "<input type=\"password\" id=\"txtsenha\" name=\"senhapart\" maxlength=\"50\" placeholder=\"Informar a senha\" />";
								?>
							</div>
							<div>
								<label for="txtdescricao">Descrição do Participante</label>
							</div>
							<div>
								<?php
									echo "<textarea id=\"txtdescricao\" maxlength=\"5000\" name=\"descricaopart\" placeholder=\"Descrição do participante\">".$part->getDescricao()."</textarea>";
								?>
							</div>
							<?php
								require_once("classes/estados.php");
								require_once("classes/cidades.php");
								$estado = new Estado();
								$vetorest = $estado->pesquisaEstados();
								
								echo "<div><label for=\"cbestado\">Estado do Participante</label></div>";
								echo "<div><select id=\"cbestado\" name=\"cbestadopart\">";
								echo "<option value=\"0\">Selecione um estado</option>";		
								for ($i = 0; $i <= count($vetorest) - 1; $i++)
								{																												
									if ($part->getCidade()->getEstado()->getIdEstado()==$vetorest[$i]->getIdEstado())
									{
										echo "<option value=\"".($vetorest[$i]->getIdEstado())."\"selected>".($vetorest[$i]->getNomeEstado())."</option>";
									}
									else
									{
										echo "<option value=\"".($vetorest[$i]->getIdEstado())."\">".($vetorest[$i]->getNomeEstado())."</option>";
									}
								}
								echo "</select></div>";								
									
								echo "<div><label for=\"cbcidade\">Cidade do Participante</label></div>";
								
								$cidade = new Cidade();
								$vetorcid = $cidade->pesquisaCidadesEstado($part->getCidade()->getEstado());
															
								
								echo "<div><select id=\"cbcidade\" name=\"cbcidadepart\">";															
								for ($i = 0; $i <= count($vetorcid) - 1; $i++)
								{																												
									if ($part->getCidade()->getIdCidade()==$vetorcid[$i]->getIdCidade())
									{
										echo "<option value=\"".($vetorcid[$i]->getIdCidade())."\"selected>".($vetorcid[$i]->getNomeCidade())."</option>";
									}
									else
									{
										echo "<option value=\"".($vetorcid[$i]->getIdCidade())."\">".($vetorcid[$i]->getNomeCidade())."</option>";
									}
								}							
								echo "</select></div>";		
																					
							?>
							
							<script src="http://www.google.com/jsapi"></script>
									<script type="text/javascript">
										google.load('jquery', '1.3');
							</script>
							
							<script type="text/javascript">
								$(function(){
									$('#cbestado').change(function(){
										if( $(this).val() ) {
											$('#cbcidade').hide();
											$('.carregando').show();
											$.getJSON('classes/cidades.ajax.php?search=',{cod_estados: $(this).val(), ajax: 'true'}, function(j){
												var options = '<option value=""></option>';	
												for (var i = 0; i < j.length; i++) {
													options += '<option value="' + j[i].idCidade + '">' + j[i].nomeCidade + '</option>';
												}	
												$('#cbcidade').html(options).show();
												$('.carregando').hide();
											});
										} else {
											$('#cbcidade').html('<option value="">– Escolha um estado –</option>');
										}
									});
								});
							</script>
							
							<div>
								<label for="arqfoto">Foto do Participante</label>
							</div>
							<div>
								<input type="file" id="arqfoto" name="fotopart" />
							</div>
							<div id="btnparticipante">
								<button type="submit">Gravar Alteração do Participante</button>
							</div>
						</fieldset>
					</form>            
				</div>
			</section>
			<footer id="rodapeparticipante">            
				<small class="text-center">Autor: Carlos Henrique Coimbra Possa - 2014</small>                        
			</footer>
			</footer>
			<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
			<!-- Include all compiled plugins (below), or include individual files as needed -->
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<div>
    </body>
</html>