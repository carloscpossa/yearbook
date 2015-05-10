<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" lang="pt-br" />
        <title>Yearbook DAW - Cadastro de Participante - PUC 2014</title>
        <link rel="stylesheet" href="estilos/estilo.css" />
    </head>
    <body>
        <header> <!-- seção para separar o título -->                        
            <h1>Cadastro de Participante</h1>
            <p>Yearbook - Especialização em Desenvolvimento de Sistemas para Web - PUC MINAS 2014</p>
        </header>		
        <section>
            <div class="cadastro">
                <form id="fparticipante" role="form" method="post" action="insere_participantes.php" enctype="multipart/form-data">                                    
					<input type="hidden" name="MAX_FILE_SIZE" value="1500000" >
                    <fieldset>
                        <legend>Dados do Participante</legend>						
                        <div>
                            <label for="nome">Nome do Participante</label>
                        </div>
                        <div>
                            <input type="text" id="nome" name="nomecompleto" maxlength="50" placeholder="Informar o nome completo" />
                        </div>
                        <div>
                            <label for="email">E-mail do Participante</label>
                        </div>
                        <div>
                            <input type="email" id="email" name="email" maxlength="50" placeholder="Informar o e-mail" />
                        </div>
						<div>
                            <label for="txtlogin">Login do Participante</label>
                        </div>
                        <div>
                            <input type="text" id="txtlogin" name="loginpart" maxlength="20" placeholder="Informar o login" />
                        </div>
						<div>
                            <label for="txtsenha">Senha do Participante</label>
                        </div>
                        <div>
                            <input type="password" id="txtsenha" name="senhapart" maxlength="50" placeholder="Informar a senha" />
                        </div>
                        <div>
                            <label for="txtdescricao">Descrição do Participante</label>
                        </div>
                        <div>
                            <textarea id="txtdescricao" maxlength="5000" name="descricaopart" placeholder="Descrição do participante"></textarea>                            
                        </div>
						<?php
							require_once("classes/estados.php");
							$estado = new Estado();
							$vetorest = $estado->pesquisaEstados();
							
							echo "<div><label for=\"cbestado\">Estado do Participante</label></div>";
							echo "<div><select id=\"cbestado\" name=\"cbestadopart\">";
							echo "<option value=\"0\">Selecione um estado</option>";		
							for ($i = 0; $i <= count($vetorest) - 1; $i++)
							{																		
								echo "<option value=\"".($vetorest[$i]->getIdEstado())."\">".($vetorest[$i]->getNomeEstado())."</option>";															
							}
							echo "</select></div>";								
								
							echo "<div><label for=\"cbcidade\">Cidade do Participante</label></div>";
							echo "<div><select id=\"cbcidade\" name=\"cbcidadepart\"><option value=\"\">-- Escolha um estado --</option></select></div>";															
																				
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
							<button type="submit">Gravar Participante</button>
						</div>
                    </fieldset>
                </form>				
            </div>
        </section>
        <footer id="rodapeparticipante">            
            <small>Autor: Carlos Henrique Coimbra Possa - 2014</small>                        
        </footer>
    </body>
</html>