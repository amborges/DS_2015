<?php if ( ! defined('ABSPATH')) exit; ?>

<h1>Bem-vindo Coordenador</h1>

<div class="row">
    <div class="col-xs-offset-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
        <h4>Editar Professor</h4>
    </div>
</div>


<form class="form-horizontal" action="<?php echo BASE_URL; ?>cadastro/editar_professor" method="post">
  <div class="row">
    <div class="col-xs-offset-1 col-xs-8 col-lg-offset-1 col-lg-8 col-md-offset-1 col-md-8 col-sm-offset-1 col-sm-8">
      <!-- Botões - Salvar -->
      <div class="form-group">                    
          <button class="col-lg-offset-10 btn btn-default" type="submit">Salvar</button>
      </div>
      
      <!-- Accordion de atividades -->
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <?php
          
		        if (isset($usuarios)) {
		        		$loop = 0;
		            $expanded = 'true';
		            $classOne = '';
		            $classTwo = 'panel-collapse collapse in';
	                
		            foreach ($usuarios as $user) {
		            	$id = 'heading' . $loop;
	              	$collapse = 'collapse' . $loop;
	              	
	              	$paneltype = "panel-default"; //eh professor
	              	$selectProfessor = true; 
	            			//cores nos panels
	            		if($user['ehCoordenador'] === '1'){
	            			$paneltype = 'panel-info';
	            			$selectProfessor = false;
	            		}
	              	
		            	?>
		            	
		            	<div class="panel <?php echo $paneltype; ?>">
	                	<div class="panel-heading" role="tab" id="'<?php echo $id; ?>'">
	                		<h4 class="panel-title">
	                			<a <?php echo $classOne; ?> data-toggle="collapse" data-parent="#accordion" href="#<?php echo $collapse; ?>" aria-expanded="<?php echo $expanded; ?>" aria-controls="<?php echo $collapse; ?>"> <?php echo $user['nome']; ?></a>
	                		</h4>
	                	</div>
	                <div id="<?php echo $collapse; ?>" class="<?php echo $classTwo; ?>" role="tabpanel" aria-labelledby="<?php echo $id; ?>">
	                <div class="panel-body">
		            	
		            	<!-- SIAPE -->
									<div class="form-group">
											<label for="siape<?php echo $id; ?>" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">SIAPE:</label>
											<div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
													<input id="siape<?php echo $id; ?>" name="siape[]" type="number" required="true" class="form-control" title="Número SIAPE do Professor" value="<?php echo $user['siape']; ?>" />
													<input id="siape_original<?php echo $id; ?>" name="siape_original[]" type="hidden" value="<?php echo $user['siape']; ?>" />
											</div>                         
									</div>

									<!-- Nome -->
									<div class="form-group">
											<label for="nome<?php echo $id; ?>" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Nome:</label>
											<div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
													<input id="nome<?php echo $id; ?>" name="nome[]" type="text" required="true" class="form-control" title="Nome completo do professor" pattern="([A-Z].[a-z]+(\s?))+" value="<?php echo $user['nome']; ?>" />
											</div>                         
									</div>
				
									<!-- E-Mail ->
									<div class="form-group">
											<label for="email" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">E-Mail:</label>
											<div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
													<input id="email" name="email" type="email" required="true" class="form-control" title="E-Mail do professor: exemplo@server.com" value="<?php echo $user['email']; ?>" />
											</div>                         
									</div-->
									
									<!-- Curso -->
									<div class="form-group">
										<label for="curso" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label"><span class="red_bold">*</span>Curso:</label>
										<div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
											<select id="curso" name="idCurso" required class="form-control">
													  <?php
									                    echo '<option value=""></option>';
									                    foreach($cursos as $curso)
									                    {
									                        $selected = '';
									                        if (isset($idCurso) && $idCurso == $curso['idCurso']) {
									                            $selected = 'selected';
									                        }
									                        echo '<option value="'. $curso['idCurso'] . '" '. $selected . ' >' . $curso['nomeCurso'] . '</option>';
									                    }
									                    //unset($cursos);
								                	?>


												  
												</select>
										</div>                         
									</div>
									
									<!-- Tipo -->
									<div class="form-group">
											<label for="tipo<?php echo $id; ?>" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Tipo de Usuário:</label>
											<div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
													<select id="tipo<?php echo $id; ?>" name="tipo[]" required="true" class="form-control"/>
														<option value=""></option>
														<option value="coordenador" <?php echo ($selectProfessor) ? "" : "selected"; ?>>Coordenador</option>
														<option value="professor" <?php echo ($selectProfessor) ? "selected" : ""; ?>>Professor</option>
													</select>
											</div>  
									</div>
				
									<!-- Senha -->
									<div class="form-group">
											<label for="senha<?php echo $id; ?>" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Redefinir Senha:</label>
											<div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
													<input id="senha<?php echo $id; ?>" name="senha[]" type="password" class="form-control" min="1" />
											</div>                         
									</div>
				
									<!-- Senha2 -->
									<div class="form-group">
											<label for="senha2_<?php echo $id; ?>" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Redigite a Senha:</label>
											<div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
													<input id="senha2_<?php echo $id; ?>" name="senha2[]" type="password" class="form-control" min="1" />
											</div>                         
									</div>
									
									<!-- fim do pannel collapse -->
									</div>
	                </div>
	                </div> 
	                <?php
	                if ($expanded === 'true') {
	                    $expanded = 'false';
	                }
	                
	                if ($classOne === '') {
	                    $classOne = 'class="collapsed"';
	                }
	                
	                if ($classTwo === 'panel-collapse collapse in') {
	                    $classTwo = 'panel-collapse collapse';
	                }
	                $loop += 1;
              	} //fim do foreach
              } //fim do if isset
              
              unset($usuarios);
              
          	//fim do codigo php
          	?>            
      </div>
      
      <!-- Botões - Salvar -->
      <div class="form-group">                    
          <button class="col-lg-offset-10 btn btn-default" type="submit">Salvar</button>
      </div>
    </div>
  </div>
</form>

