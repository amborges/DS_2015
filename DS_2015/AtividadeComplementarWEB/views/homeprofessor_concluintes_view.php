<?php if ( ! defined('ABSPATH')) exit; ?>

	<!-- MOSTRA A LISTA DE ALUNOS ATRAVÉS DE $_POST -->

	<div class="row">
    <div class="col-xs-offset-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
        <h4>Alunos Concluintes</h4>
    </div>
	</div>

	<!-- Imprime uma lista dos alunos concluintes do determinado semestre do ano -->
	<?php echo date("Y"). "/"; echo  ((integer)date("m") > 8) ? "2": "1" ; ?>
	<ul>
	<?php for($i = 0; $i < sizeof($_POST); $i++){ ?>
		<li><?php echo $_POST[$i][1]; ?></li>
		
	<?php } /*Fim do laço for*/ ?>
	</ul>