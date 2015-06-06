<?php if ( ! defined('ABSPATH')) exit; ?>

<h1>Bem-vindo ALUNO</h1>

<?php
	/*
		Mostra a janela de cadastro de uma atividade
	*/
?>

<div class="row">
    <div class="col-xs-offset-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
        <h4>Cadastrar nova atividade</h4>
    </div>
</div>

<form class="form-horizontal" action="<?php echo BASE_URL; ?>cadastro/cadastrar_atividade" method="post">
    <!-- Descrição -->
    <div class="form-group">
        <label for="descricao" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Descrição:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <textarea id="descricao" name="descricao" rows="3" cols="50" required="true" class="form-control" maxlength="255" title="Descreva a atividade" /></textarea>
        </div>                         
    </div>

    <!-- GrandeArea -->
    <div class="form-group">
        <label for="grandearea" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Grande Área:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <select id="grandearea" name="grandearea" required="true" class="form-control"/>
            	<!-- DESEVOLVER UM ALGORITMO PARA MOSTRAR AS GRANDEAREAS DO CURSO -->
            	<option value="Ensino">Ensino</option>
            	<option value="Extensao">Extensao</option>
            	<option value="Pesquisa">Pesquisa</option>
            </select>
        </div>                         
    </div>

    <!-- Categoria -->
    <div class="form-group">
        <label for="grandearea" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Categoria:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <select id="grandearea" name="grandearea" required="true" class="form-control" maxlength="128"/>
            	<!-- DESEVOLVER UM ALGORITMO DINAMICO PARA MOSTRAR AS CATEGORIAS -->
            	<option value="Ensino">AAA</option>
            	<option value="Extensao">BBB</option>
            	<option value="Pesquisa">CCC</option>
            </select>
        </div>                         
    </div>
    
    <!-- Horas -->
    <div class="form-group">
        <label for="horas" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Horas:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="horas" name="horas" type="number" required="true" class="form-control" min="1" />
        </div>                         
    </div>
    
    <!-- Data Inicial -->
    <div class="form-group">
        <label for="datainicial" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Data Inicial:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="datainicial" name="datainicial" type="date" required="true" class="form-control" pattern="[0-9]{2}/[0-9]{2}/[0-9]{2}" title="Forneça uma data no formato dd/mm/aa" />
        </div>
    </div>
    
    <!-- Data final -->
    <div class="form-group">
        <label for="datafinal" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Data Final:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="datafinal" name="datafinal" type="date" class="form-control" pattern="[0-9]{2}/[0-9]{2}/[0-9]{2}" title="Forneça uma data no formato dd/mm/aa" />
        </div>
    </div>
    
    <!-- Arquivo PDF -->
    <div class="form-group">
        <label for="certificado" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Certificado:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="certificado" name="certificado" type="file" class="form-control" />
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
                
