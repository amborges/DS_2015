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
        if ( ! isset($_POST['matricula'])) {
            redirect('login');
        }
        
        /* Obter matricula */
        $matricula = filter_input(INPUT_POST, 'matricula');
        
        /* Obter senha */
        $senha = filter_input(INPUT_POST, 'senha');
        
        $this->realizar_login($matricula, $senha);
    }
    
    public function logar_cadastro($matricula = NULL, $senha = NULL) {
        if ( ! isset($_POST['matricula'])) {
            redirect('login');
        }
        
        $this->realizar_login($matricula, $senha);
    }
        
    private function realizar_login($matricula, $senha) {
        require_once ABSPATH . '/models/aluno_model.php';
        $aluno_model = new AlunoModel();
        
        $result = $aluno_model->verifica_login($matricula, $senha);
        
        if ($result != NULL) {
            $user = array('matricula' => $result['matricula'],
                          'nomeAluno' => $result['nomeAluno'],
                          'idCurso' => $result['idCurso']);
                          
            // Envia os dados de usuário para a sessão
            $_SESSION['userdata'] = $user;

            // Atualiza o ID da sessão
            session_regenerate_id();
            $_SESSION['userdata']['user_session_id'] = session_id();
            
            redirect('homealuno');
        } else {
        		require_once ABSPATH . '/models/coordenador_model.php';
        		$login_model = new CoordenadorModel(); //vale tanto pra coordenador 
        																						//como para professor
        		$result = $login_model->verifica_login($matricula, $senha);
        
				    if ($result != NULL) {
				        $user = array('siape' => $result['siape'],
				                      'nome' => $result['nome'],
				                      'ehCoordenador' => $result['ehCoordenador']);

				        // Envia os dados de usuário para a sessão
				        $_SESSION['userdata'] = $user;

				        // Atualiza o ID da sessão
				        session_regenerate_id();
				        $_SESSION['userdata']['user_session_id'] = session_id();
				        
				        if($_SESSION['userdata']['ehCoordenador'] === '1')
				        	redirect('homecoordenador');
				        else
				        	redirect('homeprofessor');
				    } else {
				        $this->credenciais_invalidas();
				    }
        }
    }
    
    public function sair() {
        // Remover os dados da sessão
		$_SESSION['userdata'] = array();
		
		unset($_SESSION['userdata']);
		
		session_regenerate_id();
		
		redirect('login');
    }
    
    private function credenciais_invalidas() {
        $alert = array('type' => 'danger',
                       'message' => 'Credenciais inválidas!');
        	
        $main_page = ABSPATH . '/views/login_page.php';
        require ABSPATH . '/views/includes/template.php';
    }
}
