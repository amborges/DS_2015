<?php

/**
 * Description of home_controller
 *
 * @author Alex
 */
class HomeCoordenadorController {
    
  public function index() {
    require_once ABSPATH . '/functions/atividades_functions.php';
    $menus = AtividadesFunctions::init_menus("coordenador", 0);
    $main_page = ABSPATH . '/views/homecoordenador_view.php';   
    require ABSPATH . '/views/includes/template.php';
  }
    
  public function novoprofessor($alert = NULL){
  	require_once ABSPATH . '/functions/atividades_functions.php';
  	$menus = AtividadesFunctions::init_menus("coordenador", 1);
  	$main_page = ABSPATH . '/views/homecoordenador_novoprofessor_view.php';
  	require ABSPATH . '/views/includes/template.php';
  }
  
  public function editarprofessor(){
  	require_once ABSPATH . '/functions/atividades_functions.php';
  	$menus = AtividadesFunctions::init_menus("coordenador", 2);
  	$main_page = ABSPATH . '/views/homecoordenador_editarprofessor_view.php';
  	require ABSPATH . '/views/includes/template.php';
  }
  
  public function memorando(){
  	require_once ABSPATH . '/functions/atividades_functions.php';
  	$menus = AtividadesFunctions::init_menus("coordenador", 3);
  	$main_page = ABSPATH . '/views/homecoordenador_memorando_view.php';
  	require ABSPATH . '/views/includes/template.php';
  }
}
