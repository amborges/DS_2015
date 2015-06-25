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
	  		else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	  			$this->dados_invalidos_prof("Insira um e-mail válido no campo 'E-Mail'!");
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
    
    
    public function cadastrar_atividade() {
    		if(!$_POST) redirect('homealuno/cadastrar');
    		
	  		if(!is_numeric($_POST['grandearea']) && $_POST['grandearea'] === 0)
	  			$this->dados_invalidos_ativ("Selecione uma opção válida em 'Grande Area'!");
	  		if(!is_numeric($_POST['categoria']) && $_POST['categoria'] === 0)
	  			$this->dados_invalidos_ativ("Selecione uma opção válida em 'Categoria'!");
	  		if(!is_numeric($_POST['horas']) && $_POST['horas'] <= 0)
		  		$this->dados_invalidos_ativ("Informe um valor válido em 'Horas'!");
	  		else{
	  			try{
		      	//verificando se o upload foi tudo certo
		      	if(!isset($_FILES['certificado']['error']) 
		      		|| is_array($_FILES['certificado']['error'])){
							throw new RuntimeException('Parametros de Arquivo Inválidos!');
						}
						// Check $_FILES['fileToUpload']['error'] value.
						switch ($_FILES['certificado']['error']) {
							case UPLOAD_ERR_OK: break;
							case UPLOAD_ERR_NO_FILE: 
								throw new RuntimeException('Nenhum Arquivo foi enviado!');
							case UPLOAD_ERR_INI_SIZE:
							case UPLOAD_ERR_FORM_SIZE: 
								throw new RuntimeException('Tamanho de Arquivo Excedido!');
							default: throw new RuntimeException('Erro Desconhecido');
						}
					
						// You should also check filesize here.
						if ($_FILES['certificado']['size'] > 1000000) {
							throw new RuntimeException('Tamanho de Arquivo Excedido!');
						}
					
						// DO NOT TRUST $_FILES['fileToUpload']['mime'] VALUE !!
						// Check MIME Type by yourself.
						/*$finfo = new finfo(FILEINFO_MIME_TYPE);
						if (false === $ext = array_search(
							$finfo->file($_FILES['fileToUpload']['tmp_name']),
							array(
								'xml' => 'text/xml',
							),
							true
						)){
							print_r($finfo);
							throw new RuntimeException('Invalid file format.');
						}*/
					
						$ext = "pdf";
		  
						// You should name it uniquely.
						// DO NOT USE $_FILES['fileToUpload']['name'] WITHOUT ANY VALIDATION !!
						// On this example, obtain safe unique name from its binary data.
						$newName = sprintf( ABSPATH . '/uploads/%s.%s', 
							sha1_file($_FILES['certificado']['tmp_name']), $ext );
			
						if (!move_uploaded_file(
							$_FILES['certificado']['tmp_name'],
							$newName
						)) {
							throw new RuntimeException('Falha ao armazenar arquivo no Servidor!');
						}
					
					
		      } catch (RuntimeException $e) {
						$this->dados_invalidos_ativ($e->getMessage());
					} //end of try
					
					//Agora sim podemos enviar para o BD
					
					require_once ABSPATH . '/models/atividade_model.php';
	  			$atividademodel = new AtividadeModel();
	  			$atividademodel->cadastrar_nova_atividade($_POST, $newName);
	  			if($atividademodel->erro_BD())
	  				$this->dados_invalidos_ativ($atividademodel->msg_erro());
	  			else{
	  				$sucess = array('type' => 'success',
                       'message' => "Novo Aluno cadastrado com sucesso");
        		require_once ABSPATH . '/controllers/homealuno_controller.php';
        		(new HomeAlunoController)->cadastrar($sucess);
        	}
	  		
	  		}//end of else
    }
    
    private function dados_invalidos_ativ($msg) {
        $alert = array('type' => 'danger',
                       'message' => $msg);
        require_once ABSPATH . '/controllers/homealuno_controller.php';
        (new HomeAlunoController)->cadastrar($alert);
    }
}
