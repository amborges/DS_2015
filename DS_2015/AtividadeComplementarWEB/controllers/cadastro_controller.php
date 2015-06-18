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
    		
    	//Array ( [matricula] => 122 [nome] => qwwe [email] => qw@la.com [curso] => 1 [senha] => ka [repetir_senha] => ka ) 
    	
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
	  			
        //redirect('home');
      }
    }
    
    private function dados_invalidos($msg) {
        $error = array('type' => 'danger',
                       'message' => $msg);
        $this->aluno($error);
    }
    
}
