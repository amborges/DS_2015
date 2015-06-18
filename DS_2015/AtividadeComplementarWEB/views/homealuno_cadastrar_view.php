<?php if ( ! defined('ABSPATH')) exit; ?>

<div class="row">
    <div class="col-xs-offset-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
        <h4>Cadastrar nova atividade</h4>
    </div>
</div>

<div class="row">
    <form class="form-horizontal" action="<?php echo BASE_URL; ?>cadastro/cadastrar_atividade" method="post">
        <!-- Descrição -->
        <div class="form-group">
            <label for="descricao" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label"><span class="red_bold">*</span> Descrição:</label>
            <div class="col-xs-5 col-lg-5 col-md-5 col-sm-5">
                <textarea id="descricao" name="descricao" rows="3" cols="50" required="true" class="form-control" maxlength="255" placeholder="Descreva a atividade" /></textarea>
            </div>                         
        </div>

        <!-- GrandeArea -->
        <div class="form-group">
            <label for="grandearea" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label"><span class="red_bold">*</span> Grande Área:</label>
            <div class="col-xs-5 col-lg-5 col-md-5 col-sm-5">
                <select id="grandearea" name="grandearea" required="true" class="form-control"/>
                    <option value=""></option>
                    <?php
                        foreach($grandes_areas as $grande_area) {
                            echo '<option value="'. $grande_area['seqGA'] . '">' . $grande_area['nomeGA'] . '</option>';
                        }
                    ?>
                </select>
            </div>                         
        </div>

        <!-- Categoria -->
        <div class="form-group">
            <label for="grandearea" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label"><span class="red_bold">*</span> Categoria:</label>
            <div class="col-xs-5 col-lg-5 col-md-5 col-sm-5">
                <select id="grandearea" name="grandearea" required="true" class="form-control" maxlength="128"/>
                    <!-- DESEVOLVER UM ALGORITMO DINAMICO PARA MOSTRAR AS CATEGORIAS -->
                    <option value=""></option>
                    <option value="Ensino">AAA</option>
                    <option value="Extensao">BBB</option>
                    <option value="Pesquisa">CCC</option>
                </select>
            </div>                         
        </div>

        <!-- Horas -->
        <div class="form-group">
            <label for="horas" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label"><span class="red_bold">*</span> Horas:</label>
            <div class="col-xs-5 col-lg-5 col-md-5 col-sm-5">
                <input id="horas" name="horas" type="number" required="true" class="form-control" min="1" />
            </div>                         
        </div>

        <!-- Data Inicial -->
        <div class="form-group">
            <label for="datainicial" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label"><span class="red_bold">*</span> Data Inicial:</label>
            <div class="col-xs-5 col-lg-5 col-md-5 col-sm-5">
                <input id="datainicial" name="datainicial" type="text" required="true" class="form-control date_picker"/>
            </div>
        </div>

        <!-- Data final -->
        <div class="form-group">
            <label for="datafinal" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Data Final:</label>
            <div class="col-xs-5 col-lg-5 col-md-5 col-sm-5">
                <input id="datafinal" name="datafinal" type="text" class="form-control date_picker"/>
            </div>
        </div>

        <!-- Arquivo PDF -->
        <div class="form-group">
            <label for="certificado" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label"><span class="red_bold">*</span> Certificado:</label>
            <div class="col-xs-5 col-lg-5 col-md-5 col-sm-5">
                <input id="certificado" name="certificado" required="true" type="file" class="form-control" />
            </div>
        </div>

        <!-- ReCaptcha -->
        <div class="form-group">
            <div class="col-xs-offset-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
                <h3>RECAPTCHA</h3>
            </div>
        </div>

        <!-- Botões - Cadastrar e Voltar -->
        <div class="form-group">                    
            <button class="col-lg-offset-5 btn btn-default" type="submit">Incluir</button>
        </div>

    </form>
</div>
               
<link href="<?php echo BASE_URL; ?>js/jquery-ui-1.11.4.datapicker/jquery-ui.min.css" rel="stylesheet">
<script src="<?php echo BASE_URL; ?>js/jquery-ui-1.11.4.datapicker/external/jquery/jquery.js"></script>
<script src="<?php echo BASE_URL; ?>js/jquery-ui-1.11.4.datapicker/jquery-ui.min.js"></script>
<script src="<?php echo BASE_URL; ?>js/jquery-ui-1.11.4.datapicker/i18n/datepicker-pt-BR.js"></script>
<script src="<?php echo BASE_URL; ?>js/masked_input/jquery.maskedinput.min.js"></script>

<script>
    $(".date_picker").datepicker({
        changeMonth: true,
        changeYear: true
    });
    
    $(".date_picker").mask("99/99/9999");
</script>
