<?php

/**
 * Description of home_controller
 *
 * @author Paulo
 */
class LoginController {
    
    public function index() {
        $main_page = ABSPATH . '/views/login_page.php';
        
        require ABSPATH . '/views/includes/template.php';
    }
    
    public function logar() {
        /*
        Obter matricula
        filter_input(INPUT_POST, 'matricula')
        */
        /* 
        Obter senha
        filter_input(INPUT_POST, 'senha')
        */
        // CRIAR SESSÃO
        redirect('home');
    }
    
    public function sair() {
        // MATAR SESSÃO
        redirect('login');
    }
    
}