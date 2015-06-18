<?php if ( ! defined('ABSPATH')) exit; ?>

<div class="col-lg-offset-1 col-sm-offset-1 col-md-offset-1 col-xs-offset-1">
    <?php
        /*
            A tela inicial vai mostrar apenas o gráfico
            FONTE do grafico:
            http://www.devmedia.com.br/criando-graficos-com-php/11466#ixzz3cDakPfLZ
        */

        $userName = "FULANO DE TAL";
        
        echo '<h1>Bem-vindo ' . $nome_aluno . '</h1>';
        
        require_once ABSPATH . "/functions/plot_functions.php";
        $plot = new PlotFunctions($nome_aluno, $_POST);

        echo "<img src=\"". $plot->getImage() . "\" />";
    ?>
</div>