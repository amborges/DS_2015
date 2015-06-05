<form class="form-horizontal" action="<?php echo BASE_URL; ?>atividades/salvar" method="post">
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
                            $id = 'heading' . $atividade['id'];
                            $collapse = 'collapse' . $atividade['id'];
                            echo '<div class="panel panel-default">';
                            echo '<div class="panel-heading" role="tab" id="' . $id . '">';
                            echo '<h4 class="panel-title">';
                            echo '<a ' . $classOne . ' data-toggle="collapse" data-parent="#accordion" href="#' . $collapse . '" aria-expanded="' . $expanded . '" aria-controls="' . $collapse . '">';
                            echo $atividade['descricao'];
                            echo '</a>';
                            echo '</h4>';
                            echo '</div>';
                            echo '<div id="' . $collapse . '" class="' . $classTwo . '" role="tabpanel" aria-labelledby="' . $id . '">';
                            echo '<div class="panel-body">';
                            
                            // Descrição
                            echo '<div class="form-group">';
                            echo '<label for="descricao[]" class="col-xs-3 col-lg-3 col-md-3 col-sm-3 control-label">Descrição:</label>';
                            echo '<div class="col-xs-8 col-lg-8 col-md-8 col-sm-8">';
                            echo '<input id="descricao[]" name="descricao[]" type="text"  value="' . $atividade['descricao'] . '" required="true" class="form-control" maxlength="128"/>';
                            echo '</div>';                       
                            echo '</div>';
                            
                            // Grande área
                            echo '<div class="form-group">';
                            echo '<label for="grande_area[]" class="col-xs-3 col-lg-3 col-md-3 col-sm-3 control-label">Grande área:</label>';
                            echo '<div class="col-xs-8 col-lg-8 col-md-8 col-sm-8">';
                            echo '<select id="grande_area[]" name="grande_area[]" class="form-control">';
                            echo '<option value="0"></option>';
                            
                            foreach($grandes_areas as $grande_area) {
                                $selected = ($atividade['grande_area'] === $grande_area['nomeGA']) ? 'selected' : '';
                                echo '<option value="'. $grande_area['seqGA'] . '" '. $selected . ' >' . $grande_area['nomeGA'] . '</option>';
                            }
                                
                            echo '</select>';
                            echo '</div>';                       
                            echo '</div>';
                            
                            // Categoria
                            echo '<div class="form-group">';
                            echo '<label for="categoria[]" class="col-xs-3 col-lg-3 col-md-3 col-sm-3 control-label">Categoria:</label>';
                            echo '<div class="col-xs-8 col-lg-8 col-md-8 col-sm-8">';
                            echo '<select id="categoria[]" name="categoria[]" class="form-control">';
                            echo '<option value="0"></option>';
                            
                            foreach($categorias as $categoria) {
                                $selected = ($atividade['categoria'] === $categoria['nomeCategoria']) ? 'selected' : '';
                                echo '<option value="'. $categoria['seqCategoria'] . '" '. $selected . ' >' . $categoria['nomeCategoria'] . '</option>';
                            }
                                
                            echo '</select>';
                            echo '</div>';                       
                            echo '</div>';
                            
                            // Horas
                            echo '<div class="form-group">';
                            echo '<label for="horas[]" class="col-xs-3 col-lg-3 col-md-3 col-sm-3 control-label">Horas:</label>';
                            echo '<div class="col-xs-8 col-lg-8 col-md-8 col-sm-8">';
                            echo '<input id="horas[]" name="horas[]" type="text"  value="' . $atividade['horas'] . '" required="true" class="form-control" maxlength="128"/>';
                            echo '</div>';                       
                            echo '</div>';
                                
                            // Data inicial
                            echo '<div class="form-group">';
                            echo '<label for="data_inicial[]" class="col-xs-3 col-lg-3 col-md-3 col-sm-3 control-label">Data inicial:</label>';
                            echo '<div class="col-xs-8 col-lg-8 col-md-8 col-sm-8">';
                            echo '<input id="data_inicial[]" name="data_inicial[]" type="text"  value="' . $atividade['data_inicial'] . '" required="true" class="form-control" maxlength="128"/>';
                            echo '</div>';                       
                            echo '</div>';
                            
                            // Data final
                            echo '<div class="form-group">';
                            echo '<label for="data_final[]" class="col-xs-3 col-lg-3 col-md-3 col-sm-3 control-label">Data final:</label>';
                            echo '<div class="col-xs-8 col-lg-8 col-md-8 col-sm-8">';
                            echo '<input id="data_final[]" name="data_final[]" type="text"  value="' . $atividade['data_final'] . '" class="form-control" maxlength="128"/>';
                            echo '</div>';                       
                            echo '</div>';
                            
                            // Certificado
                            echo '<div class="form-group">';
                            echo '<label for="certificado[]" class="col-xs-3 col-lg-3 col-md-3 col-sm-3 control-label">Certificado:</label>';
                            echo '<div class="col-xs-8 col-lg-8 col-md-8 col-sm-8">';
                            echo '<input id="certificado[]" name="certificado[]" type="file" class="form-control" maxlength="128"/>';
                            echo '</div>';                       
                            echo '</div>';
                            
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