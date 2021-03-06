<?php

/**
 * Description of home_controller
 *
 * @author Paulo
 */
class CadastroController {
    
    public function index() {
        redirect('login');
    }
    
    public function aluno($alert = NULL) {
    		    
    		require_once ABSPATH . '/models/curso_model.php';
    		
        $cursos = (new CursoModel())->get_curso(); // buscar da base de dados
        
        $main_page = ABSPATH . '/views/cadastro_aluno_page.php';
        
        require ABSPATH . '/views/includes/template.php';
    }
    
    public function cadastrar_aluno() {
    		if(!$_POST) redirect('cadastro/aluno');
    		
    		//verificando se os dados são válidos
	  		if(!is_numeric($_POST['matricula']))
	  			$this->dados_invalidos("Insira um valor numérico no campo 'Matrícula'!");
	  		else if(sizeof(explode(" ", $_POST['nome'])) < 2) //nome _espaço_ sobrenome
	  			$this->dados_invalidos("Insira um nome válido no campo 'Nome'!");
	  		else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	  			$this->dados_invalidos("Insira um e-mail válido no campo 'E-Mail'!");
	  		else if(!($_POST['senha'] === $_POST['repetir_senha']))
	  			$this->dados_invalidos("Senhas não conferem!");
	  		else{
	  			require_once ABSPATH . '/models/aluno_model.php';
	  			$alunomodel = new AlunoModel();
	  			$alunomodel->cadastrar_novo_aluno($_POST);
	  			if($alunomodel->erro_BD())
	  				$this->dados_invalidos($alunomodel->msg_erro());
	  			else{
	  				$sucess = array('type' => 'success',
                       'message' => "Novo Aluno cadastrado com sucesso");
	  				$this->aluno($sucess);
        	}
      }
    }
    
    private function dados_invalidos($msg) {
        $error = array('type' => 'danger',
                       'message' => $msg);
        $this->aluno($error);
    }
    
    public function cadastrar_professor() {
    		if(!$_POST) redirect('homecoordenador/novoprofessor');
    	
    		//verificando se os dados são válidos
	  		if(!is_numeric($_POST['siape']))
	  			$this->dados_invalidos_prof("Insira um valor numérico no campo 'Siape'!");
	  		else if(sizeof(explode(" ", $_POST['nome'])) < 2) //nome _espaço_ sobrenome
	  			$this->dados_invalidos_prof("Insira um nome válido no campo 'Nome'!");
	  		//else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	  		//	$this->dados_invalidos_prof("Insira um e-mail válido no campo 'E-Mail'!");
	  		else if(!($_POST['senha'] === $_POST['senha2']))
	  			$this->dados_invalidos_prof("Senhas não conferem!");
	  		else{
	  			require_once ABSPATH . '/models/coordenador_model.php';
	  			$coordmodel = new CoordenadorModel();
	  			$coordmodel->cadastrar_novo_professor($_POST);
	  			if($coordmodel->erro_BD())
	  				$this->dados_invalidos_prof($coordmodel->msg_erro());
	  			else{
	  				$sucess = array('type' => 'success',
                       'message' => "Novo Professor cadastrado com sucesso");
	  				require_once ABSPATH . '/controllers/homecoordenador_controller.php';
        		(new HomeCoordenadorController)->novoprofessor($sucess);
        	}
      }
    }
    
    private function dados_invalidos_prof($msg) {
        $alert = array('type' => 'danger',
                       'message' => $msg);
        require_once ABSPATH . '/controllers/homecoordenador_controller.php';
        (new HomeCoordenadorController)->novoprofessor($alert);
    }
    
    
    public function editar_professor() {
    		if(!$_POST) redirect('homecoordenador/editarprofessor');
    		
    		$alert = array('type' => 'success',
                       'message' => "");
    		
    		for($i = 0; $i < sizeof($_POST['siape']); $i++){
    		
    		//verificando se os dados são válidos
	  		if(!is_numeric($_POST['siape'][$i])){
	  			$alert['message'] .= "<br>Insira um valor numérico no campo 'Siape' para ".$_POST['nome'][$i]."!";
	  			$alert['type'] = "warning";
	  		}
	  		else if(sizeof(explode(" ", $_POST['nome'][$i])) < 2){ //nome _espaço_ sobrenome
	  			$alert['message'] .= "<br>Insira um nome válido no campo 'Nome' de ".$_POST['nome'][$i]."!";
	  			$alert['type'] = "warning";
	  		}
	  		//else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	  		//	$this->dados_invalidos_prof("Insira um e-mail válido no campo 'E-Mail'!");
	  		else if(!($_POST['senha'][$i] === $_POST['senha2'][$i])){
	  			$alert['message'] .= "<br>Senhas informadas em ".$_POST['nome'][$i]." não conferem!";
	  			$alert['type'] = "warning";
	  		}
	  		else{
	  			require_once ABSPATH . '/models/coordenador_model.php';
	  			$coordmodel = new CoordenadorModel();
	  			
	  			$user = array(
	  				'siape' => $_POST['siape'][$i],
	  				'siape_original' => $_POST['siape_original'][$i],
	  				'nome' => $_POST['nome'][$i],
	  				'senha' => $_POST['senha'][$i],
	  				'tipo' => $_POST['tipo'][$i]
	  			);
	  			$coordmodel->update_user($user);
	  			if($coordmodel->erro_BD()){
	  				$alert['message'] .= "<br>".$coordmodel->msg_erro();
	  				$alert['type'] = "warning";
					}
	  			else{
	  				$alert['message'] .= "<br>Professor ". $_POST['nome'][$i] ." atualizado com sucesso";
	  				
        	}
        	
        }
      }
      
      require_once ABSPATH . '/controllers/homecoordenador_controller.php';
      (new HomeCoordenadorController)->editarprofessor($alert);
      
    }
}
