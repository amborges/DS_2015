<?php if ( ! defined('ABSPATH')) exit; ?>

<h1>Bem-vindo Professor</h1>

	<!-- MOSTRA A LISTA DE ALUNOS ATRAVÉS DE $_POST -->

	<div class="row">
    <div class="col-xs-offset-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
        <h4>Alunos em Espera</h4>
    </div>
	</div>

	<?php for($i = 0; $i < sizeof($_POST); $i++){ ?>
		<!-- ARRUMAR ESSE LABEL, TA FINCANDO FEIO LA NA PAGINA -->
		<a href="<?php echo BASE_URL . 'homeprofessor/valide/' . $_POST[$i][0];?>">
			<label class="control-label">
				<?php echo $_POST[$i][1] . ', '. $_POST[$i][2] . '/' . $_POST[$i][3]; ?>
			</label>
		</a><br>
		
	<?php } /*Fim do laço for*/ ?>

