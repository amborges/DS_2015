<?php if ( ! defined('ABSPATH')) exit; ?>

<h1>Bem-vindo Professor</h1>

<?php 
	$mostrar_lista_de_alunos;
	if(sizeof($_POST) === 0)
		$mostrar_lista_de_alunos = false;
	else
		$mostrar_lista_de_alunos = true;
?>

<?php if($mostrar_lista_de_alunos){ ?>

	<!-- MOSTRA A LISTA DE ALUNOS ATRAVÉS DE $_POST -->

	<div class="row">
    <div class="col-xs-offset-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
        <h4>Alunos em Espera</h4>
    </div>
	</div>

	<?php for($i = 0; $i < sizeof($_POST); $i++){ ?>
		<div class="form-group">
		<!-- ARRUMAR ESSE LABEL, TA FINCANDO FEIO LA NA PAGINA -->
		<a href="<?php echo BASE_URL . 'homeprofessor/validar/' . $_POST[$i][0];?>">
			<label class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">
				<?php echo $_POST[$i][1] . ', '. $_POST[$i][2] . '/' . $_POST[$i][2]; ?>
			</label>
		</a></div>
		
	<?php } /*Fim do laço for*/ ?>

<?php } else { ?>

	<div class="row">
    <div class="col-xs-offset-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
        <h4>Atividades do aluno <?php echo $_GET['nomealuno']; ?> </h4>
    </div>
	</div>
	
	<!-- Atividades -->
    <div class="form-group">
        <label for="grandearea" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Atividades em Espera:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <select id="grandearea" name="grandearea" required="true" class="form-control" maxlength="128"/>
            	<!-- DESEVOLVER UM ALGORITMO DINAMICO PARA MOSTRAR AS ATIVIDADES -->
            	<option value="Ensino">At1</option>
            	<option value="Extensao">At2</option>
            	<option value="Pesquisa">At3</option>
            </select>
        </div>                         
    </div>
	
		<!-- Botões - Cadastrar e Voltar -->
    <div class="form-group">                    
        <button class="col-lg-offset-5 btn btn-default" type="submit">Carregar</button>
    </div>
	
	<form class="form-horizontal" action="<?php echo BASE_URL; ?>cadastro/cadastrar_atividade" method="post">
	
    <!-- Descrição -->
    <div class="form-group">
        <label for="descricao" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Descrição:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <textarea id="descricao" name="descricao" rows="3" cols="50" required="true" class="form-control" maxlength="255" title="Descreva a atividade" />
            	<?php echo $_GET['descricao']; ?>
            </textarea>
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
        <label for="horasinformadas" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Horas:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="horasinformadas" name="horasinformadas" type="number" required="true" class="form-control" min="1" value="<?php echo $_GET['horasinformadas']; ?>" />
        </div>                         
    </div>
    <div class="form-group">
        <label for="horasvalidas" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Horas:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="horasvalidas" name="horasvalidas" type="number" required="true" class="form-control" min="1" value="<?php echo $_GET['horasvalidas']; ?>" />
        </div>                         
    </div>
    
    <!-- Data Inicial -->
    <div class="form-group">
        <label for="datainicial" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Data Inicial:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="datainicial" name="datainicial" type="date" required="true" class="form-control" pattern="[0-9]{2}/[0-9]{2}/[0-9]{2}" title="Forneça uma data no formato dd/mm/aa" value="<?php echo $_GET['datainicial']; ?>" />
        </div>
    </div>
    
    <!-- Data final -->
    <div class="form-group">
        <label for="datafinal" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Data Final:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="datafinal" name="datafinal" type="date" class="form-control" pattern="[0-9]{2}/[0-9]{2}/[0-9]{2}" title="Forneça uma data no formato dd/mm/aa" value="<?php echo $_GET['datafinal']; ?>" />
        </div>
    </div>
    
    <!-- Arquivo PDF -->
    <div class="form-group">
    	<div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
    		<object data="<?php echo BASE_URL . '/uploads/' . $_GET['certificado'] . '.pdf'; ?>" type="application/pdf" width="800" height="600">
    		</object>
      </div>
    </div>
    
    <!-- Aceita ou Rejeita? -->
    <div class="form-group">
        <label for="aceito" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Atividade Aceita:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="aceito" name="aceito" type="radio" class="form-control" value="sim" checked/> sim
        </div>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="tipo" name="tipo" type="radio" class="form-control" value="nao" /> nao
        </div>
    </div>
    
    <!-- Observação -->
    <div class="form-group">
        <label for="observacao" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Observacao:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <textarea id="observacao" name="observacao" rows="3" cols="50" required="true" class="form-control" maxlength="255" title="Descreva a atividade" />
            </textarea>
        </div>                         
    </div>
    
    <!-- Botões - Cadastrar e Voltar -->
    <div class="form-group">                    
        <button class="col-lg-offset-5 btn btn-default" type="submit">Confirmar</button>
        <a href="#" class="btn btn-default" id="excluir">Realizar Alterações</a>
    </div>
    
</form>

<?php } ?>