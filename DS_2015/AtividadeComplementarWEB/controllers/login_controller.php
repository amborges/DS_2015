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
        
        // TODO - buscar o usuario do banco
        $user = array('matricula' => $matricula,
                        'nomeAluno' => 'Aluno 007',
                        'idCurso' => '1');
        
        // Envia os dados de usuário para a sessão
		$_SESSION['userdata'] = $user;
				
		// Atualiza o ID da sessão
        session_regenerate_id();
		$_SESSION['userdata']['user_session_id'] = session_id();
        
        if($matricula == "aluno")
        	redirect('homealuno');
        else if($matricula == "professor")
        	redirect('homeprofessor');
        else if($matricula == "coordenador")
        	redirect('homecoordenador');
        else{	
        	redirect('login');
        }
        
    }
    
    public function sair() {
        // Remover os dados da sessão
		$_SESSION['userdata'] = array();
		
		unset($_SESSION['userdata']);
		
		session_regenerate_id();
		
		redirect('login');
    }
    
}
