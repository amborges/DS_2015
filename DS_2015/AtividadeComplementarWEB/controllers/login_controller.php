<?php

	 if ( ! defined('ABSPATH')) exit;

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
        */
        $matricula = filter_input(INPUT_POST, 'matricula');
        
        /* 
        Obter senha
        */
        $senha = filter_input(INPUT_POST, 'senha');
        
        // CRIAR SESSÃO
        // incluir código para tal, código abaixo apenas para exemplo
				
        if($matricula == "aluno")
        	redirect('homealuno');
        else if($matricula == "professor")
        	redirect('homeprofessor');
        else if($matricula == "coordenador")
        	redirect('homecoordenador');
        else{	
        	redirect('login');
        	//$main_page = ABSPATH . '/views/login_view.php';
        	//require ABSPATH . '/views/includes/template.php';
        }
        //redirect('home');
    }
    
    public function sair() {
        // MATAR SESSÃO
        redirect('login');
    }
    
}
