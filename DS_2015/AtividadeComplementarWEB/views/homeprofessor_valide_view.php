<form class="form-horizontal" action="<?php echo BASE_URL; ?>atividades/validar" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-xs-offset-1 col-xs-8 col-lg-offset-1 col-lg-8 col-md-offset-1 col-md-8 col-sm-offset-1 col-sm-8">
            <!-- Botões - Salvar -->
            <div class="form-group">                    
                <button class="col-lg-offset-10 btn btn-default" type="submit">Salvar</button>
            </div>
            
            <!-- Accordion de atividades -->
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <?php
                    if (isset($atividades)) {
                        $expanded = 'true';
                        $classOne = '';
                        $classTwo = 'panel-collapse collapse in';
                        foreach ($atividades as $atividade) {
                        		$paneltype;
                        			//cores nos panels
                        		if($atividade['certificadocomerro'])
                        			$paneltype = 'panel-danger';
                        		else
                        			$paneltype = 'panel-default';
                        			
                        			
                            $id = 'heading' . $atividade['id'];
                            $collapse = 'collapse' . $atividade['id'];
                            echo '<div class="panel '.$paneltype.'">';
                            echo '<div class="panel-heading" role="tab" id="' . $id . '">';
                            echo '<h4 class="panel-title">';
                            echo '<a ' . $classOne . ' data-toggle="collapse" data-parent="#accordion" href="#' . $collapse . '" aria-expanded="' . $expanded . '" aria-controls="' . $collapse . '">';
                            echo $atividade['descricao'];
                            echo '</a>';
                            echo '</h4>';
                            echo '</div>';
                            echo '<div id="' . $collapse . '" class="' . $classTwo . '" role="tabpanel" aria-labelledby="' . $id . '">';
                            echo '<div class="panel-body">';
                            
                            // BOTAO REJEITA
                            echo '<div class="form-group">';
                            echo '<div class="col-md-8"></div>';
                            echo '<a href="'. BASE_URL .'atividades/rejeitar_atividade/'.$atividade['seqAtividade'].'" class="col-md-4 btn btn-danger" disabled>REJEITAR</a>';    
                            echo '</div>';
                            
                            // BOTAO ATUALIZA
                            echo '<div class="form-group">';
                            echo '<div class="col-md-8"></div>';
                            echo '<a href="'. BASE_URL .'atividades/atualizar_atividade/'.$atividade['seqAtividade'].'" class="col-md-4 btn btn-warning" disabled>ATUALIZA</a>';    
                            echo '</div>';
                            
                            // Descrição
                            echo '<div class="form-group">';
                            echo '<label for="descricao[]" class="col-xs-3 col-lg-3 col-md-3 col-sm-3 control-label"><span class="red_bold">*</span>Descrição:</label>';
                            echo '<div class="col-xs-8 col-lg-8 col-md-8 col-sm-8">';
                            echo '<input id="descricao[]" name="descricao[]" type="text"  value="' . $atividade['descricao'] . '" required="true" class="form-control" maxlength="255" />';
                            echo '<input id="seqAtividade[]" name="seqAtividade[]" type="hidden"  value="' . $atividade['seqAtividade'] . '" />';
                             echo '<input id="matricula[]" name="matricula[]" type="hidden"  value="'.$matricula.'" />';
                            echo '</div>';                       
                            echo '</div>';
                            
                            // Grande área
                            echo '<div class="form-group">';
                            echo '<label for="grande_area[]" class="col-xs-3 col-lg-3 col-md-3 col-sm-3 control-label"><span class="red_bold">*</span>Grande área:</label>';
                            echo '<div class="col-xs-8 col-lg-8 col-md-8 col-sm-8">';
                            echo '<select id="grande_area[]" name="grande_area[]" class="form-control" >';
                            echo '<option value="0"></option>';
                            
                            foreach($grandes_areas as $grande_area) {
                                $selected = ($atividade['grande_area'] === $grande_area['seqGA']) ? 'selected' : '';
                                echo '<option value="'. $grande_area['seqGA'] . '" '. $selected . ' >' . $grande_area['nomeGA'] . '</option>';
                            }
                                
                            echo '</select>';
                            echo '</div>';                       
                            echo '</div>';
                            
                            // Categoria
                            echo '<div class="form-group">';
                            echo '<label for="categoria[]" class="col-xs-3 col-lg-3 col-md-3 col-sm-3 control-label"><span class="red_bold">*</span>Categoria:</label>';
                            echo '<div class="col-xs-8 col-lg-8 col-md-8 col-sm-8">';
                            echo '<select id="categoria[]" name="categoria[]" class="form-control" >';
                            echo '<option value="0"></option>';
                            
                            foreach($atividade['categorias'] as $categoria) {
                                $selected = ($atividade['categoria'] === $categoria['seqCategoria']) ? 'selected' : '';
                                echo '<option value="'. $categoria['seqCategoria'] . '" '. $selected . ' >' . $categoria['nomeCategoria'] . '</option>';
                            }
                                
                            echo '</select>';
                            echo '</div>';                       
                            echo '</div>';
                            
                            // Horas
                            echo '<div class="form-group">';
                            echo '<label for="horas[]" class="col-xs-3 col-lg-3 col-md-3 col-sm-3 control-label"><span class="red_bold">*</span>Horas:</label>';
                            echo '<div class="col-xs-8 col-lg-8 col-md-8 col-sm-8">';
                            echo '<input id="horas[]" name="horas[]" type="text"  value="' . $atividade['horas'] . '" required="true" class="form-control" maxlength="10" />';
                            echo '</div>';                       
                            echo '</div>';
                            
                            // Horas Calculadas
                            echo '<div class="form-group">';
                            echo '<label for="horascalculadas[]" class="col-xs-3 col-lg-3 col-md-3 col-sm-3 control-label">Horas Calculadas:</label>';
                            echo '<div class="col-xs-8 col-lg-8 col-md-8 col-sm-8">';
                            echo '<input id="horascalculadas[]" name="horascalculadas[]" type="text"  value="' . $atividade['horascontabilizadas'] . '" required="true" class="form-control" maxlength="10" />';
                            echo '</div>';                       
                            echo '</div>';
                                
                            // Data inicial
                            echo '<div class="form-group">';
                            echo '<label for="data_inicial' . $atividade['id'] . '" class="col-xs-3 col-lg-3 col-md-3 col-sm-3 control-label"><span class="red_bold">*</span>Data inicial:</label>';
                            echo '<div class="col-xs-8 col-lg-8 col-md-8 col-sm-8">';
                            echo '<input id="data_inicial' . $atividade['id'] . '" name="data_inicial[]" type="text"  value="' . $atividade['data_inicial'] . '" required="true" class="form-control date_picker" maxlength="10" />';
                            echo '</div>';
                            echo '</div>';
                            
                            // Data final
                            echo '<div class="form-group">';
                            echo '<label for="data_final' . $atividade['id'] . '" class="col-xs-3 col-lg-3 col-md-3 col-sm-3 control-label">Data final:</label>';
                            echo '<div class="col-xs-8 col-lg-8 col-md-8 col-sm-8">';
                            echo '<input id="data_final' . $atividade['id'] . '" name="data_final[]" type="text"  value="' . $atividade['data_final'] . '" class="form-control date_picker" maxlength="10" />';
                            echo '</div>';                       
                            echo '</div>';
                            
                            //<!-- Arquivo PDF -->
                            echo '<div class="form-group">';
                            echo '<div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">';
                            echo '<object data="'. BASE_URL . '/uploads/' . $atividade['certificado'] . '" type="application/pdf" width="640" height="480">';
                            echo '</object>';
                            echo '</div>';
                            echo '</div>';
                                                                                    
                            //checkbox validar
                            echo '<div class="form-group">';
                            echo '<label for="validear' . $atividade['id'] . '" class="col-xs-3 col-lg-3 col-md-3 col-sm-3 control-label">Validar?</label>';

                            echo '<div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">';
                            echo '<input id="validear' . $atividade['id'] . '" name="validacao[]" type="checkbox" value="' . $atividade['id'] . '" class="form-control" maxlength="128" />';
                            echo '<label = for="validear' . $atividade['id'] . '" class=" control-label">SIM</label>';
                            echo '</div>';                       
                            echo '</div>';
                           
                           
                            //ultimos divs
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            
                            if ($expanded === 'true') {
                                $expanded = 'false';
                            }
                            
                            if ($classOne === '') {
                                $classOne = 'class="collapsed"';
                            }
                            
                            if ($classTwo === 'panel-collapse collapse in') {
                                $classTwo = 'panel-collapse collapse';
                            }
                        }
                    }
                
                    unset($atividades);
                ?>                
            </div>
            
            <!-- Botões - Salvar -->
            <div class="form-group">                    
                <button class="col-lg-offset-10 btn btn-default" type="submit">Salvar</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(".date_picker").datepicker({
        changeMonth: true,
        changeYear: true
    });
    
    $(".date_picker").mask("99/99/9999");
</script>
