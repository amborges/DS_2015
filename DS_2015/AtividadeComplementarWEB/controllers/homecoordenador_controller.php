<?php

/**
 * Description of home_controller
 *
 * @author Alex
 */
class HomeCoordenadorController {
    
    public function index() {
        require_once ABSPATH . '/functions/atividades_functions.php';
        $menus = AtividadesFunctions::init_menus(null, 0);
        $main_page = ABSPATH . '/views/home_page.php';
        
        require ABSPATH . '/views/includes/template.php';
    }    
}
