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
        /* Obter matricula */
        $matricula = filter_input(INPUT_POST, 'matricula');
        
        /* Obter senha */
        $senha = filter_input(INPUT_POST, 'senha');
        
        require_once ABSPATH . '/models/login_model.php';
        $login_model = new LoginModel();
        
        $result = $login_model->verifica_login_aluno($matricula, $senha);
        
        if ($result != NULL && ! empty($result) && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user = array('matricula' => $row['matricula'],
                          'nomeAluno' => $row['nomeAluno'],
                          'idCurso' => $row['idCurso']);

            // Envia os dados de usuário para a sessão
            $_SESSION['userdata'] = $user;

            // Atualiza o ID da sessão
            session_regenerate_id();
            $_SESSION['userdata']['user_session_id'] = session_id();

            redirect('homealuno');
        } else {	
            $this->credenciais_invalidas();
        }
        
        
        
        // TODO - buscar o usuario do banco
//        $user = array('matricula' => $matricula,
//                        'nomeAluno' => 'Aluno 007',
//                        'idCurso' => '1');
        
        
				
		
        /*
        if($matricula == "aluno")
        	redirect('homealuno');
        else if($matricula == "professor")
        	redirect('homeprofessor');
        else if($matricula == "coordenador")
        	redirect('homecoordenador');
        else{	
        	redirect('login');
        }
        */
    }
    
    public function sair() {
        // Remover os dados da sessão
		$_SESSION['userdata'] = array();
		
		unset($_SESSION['userdata']);
		
		session_regenerate_id();
		
		redirect('login');
    }
    
    private function credenciais_invalidas() {
        $error = array('type' => 'danger',
                       'message' => 'Credenciais inválidas!');
        	
        $main_page = ABSPATH . '/views/login_page.php';
        require ABSPATH . '/views/includes/template.php';
    }
}
