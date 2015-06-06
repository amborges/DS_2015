<?php

/**
 * Description of home_controller
 *
 * @author Alex
 */
class HomeAlunoController {
  
  
  public function index() {
  	require_once ABSPATH . '/functions/atividades_functions.php';
      
    /*
    	Este post serve apenas para enviar os dados a serem mostrados no grafico
    	Gerar um $_POST dinâmico, permitindo que se carregue quantos GrandeAreas
    	forem necessárias, deve-se enviar o valor acumulado pelo aluno e o mínimo
    	por cada GrandeArea. Aqui apenas coloquei 3 pra mostrar como vai ficar
    */
    
    	//$_POST[$i] = array($nomeGrandeArea, $acumulado, $minimo);
    $_POST[0] = array('Ensino', 25, 100);
    $_POST[1] = array('Pesquisa', 75, 100);
    $_POST[2] = array('Extensao', 125, 100);
    
    
    $menus = AtividadesFunctions::init_menus(null, 0);
    $main_page = ABSPATH . '/views/homealuno_view.php';
    
    require ABSPATH . '/views/includes/template.php';
  }
    
  public function cadastrar(){
  	require_once ABSPATH . '/functions/atividades_functions.php';
  	$menus = AtividadesFunctions::init_menus(null, 0);
  	$main_page = ABSPATH . '/views/homealuno_cadastrar_view.php';
      
  	require ABSPATH . '/views/includes/template.php';
  }
  
  public function visualizar(){
  	require_once ABSPATH . '/functions/atividades_functions.php';
  	$menus = AtividadesFunctions::init_menus(null, 0);
  	$main_page = ABSPATH . '/views/homealuno_visualizar_view.php';
      
  	require ABSPATH . '/views/includes/template.php';
  }   
  
  public function enviar(){
  	require_once ABSPATH . '/functions/atividades_functions.php';
  	$menus = AtividadesFunctions::init_menus(null, 0);
  	$main_page = ABSPATH . '/views/homealuno_enviar_view.php';
      
  	require ABSPATH . '/views/includes/template.php';
  }
}
