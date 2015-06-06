<?php if ( ! defined('ABSPATH')) exit; ?>

<h1>Bem-vindo ALUNO</h1>

<?php
	/*
		A tela inicial vai mostrar apenas o gráfico
		FONTE do grafico:
		http://www.devmedia.com.br/criando-graficos-com-php/11466#ixzz3cDakPfLZ
	*/
	
	$userName = "FULANO DE TAL";
	
	require_once ABSPATH . "/functions/plot_functions.php";
	$plot = new PlotFunctions($userName, $_POST);
	
	echo "<img src=\"". $plot->getImage() . "\" />";
?>
