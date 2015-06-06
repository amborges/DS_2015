<?php if ( ! defined('ABSPATH')) exit; ?>

<h1>Bem-vindo Coordenador</h1>

<?php 

	echo "<a href='#'>Usuário Coordenador: Ciclado </a><br>";
	for($i = 0; $i < 9; $i++)
		echo "<a href='#'>Usuário Professor: Fulano ". ($i+1) ."th</a><br>";

?>
