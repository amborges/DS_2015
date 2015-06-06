<?php

/**
 * Description of home_controller
 *
 * @author Alex
 */
class HomeProfessorController {
    
  public function index() {
    require_once ABSPATH . '/functions/atividades_functions.php';
    $menus = AtividadesFunctions::init_menus("professor", 0);
    $main_page = ABSPATH . '/views/homeprofessor_view.php';
    require ABSPATH . '/views/includes/template.php';
  }
  
  public function validar() {
    require_once ABSPATH . '/functions/atividades_functions.php';
    $menus = AtividadesFunctions::init_menus("professor", 1);
    $main_page = ABSPATH . '/views/homeprofessor_validar_view.php';
    require ABSPATH . '/views/includes/template.php';
  }     
}
