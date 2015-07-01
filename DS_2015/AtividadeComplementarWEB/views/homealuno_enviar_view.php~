<?php if ( ! defined('ABSPATH')) exit; 


	if($jaenviou){ ?>
		<div class="row">
				<div class="col-xs-offset-1 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
				    <h4>Aluno, aguarde a avaliação do professor!</h4>
				</div>
		</div>
	<?php }
	else if($completouAsHoras){ ?>
		<div class="row">
				<div class="col-xs-offset-1 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
				    <h4>Você têm certeza de que deseja enviar a atual lista de atividades para avaliação?</h4>
				</div>
		</div>

		<!-- Botões - SIM e NAO -->
		<div class="row">

				<div class="col-xs-offset-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
				    <a href="<?php echo BASE_URL; ?>homealuno/concluir_atividades" class="btn btn-default" id="sim">SIM</a>
				    <a href="<?php echo BASE_URL; ?>homealuno" class="btn btn-default" id="nao">NÃO</a>
				</div>
		</div>
	<?php }
	else{
	?>
	
		<div class="row">
				<div class="col-xs-offset-1 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
				    <h4>Aluno, você não possui horas mínimas concluidas!</h4>
				</div>
		</div>
	
	<?php } ?>
