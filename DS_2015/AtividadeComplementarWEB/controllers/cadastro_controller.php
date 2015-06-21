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
    
    public function aluno($error = NULL) {
        require_once ABSPATH . '/models/curso_model.php';
        
        $curso_model = new CursoModel();
        $cursos = $curso_model->find_cursos();
    
        if (isset($_POST['matricula'])) {
            $matricula      = $_POST['matricula'];
            $nome           = $_POST['nome'];
            $email          = $_POST['email'];
            $idCurso        = $_POST['curso'];
            $senha          = $_POST['senha'];
            $repetir_senha  = $_POST['repetir_senha'];
        }
        
        $main_page = ABSPATH . '/views/cadastro_aluno_page.php';
        
        require ABSPATH . '/views/includes/template.php';
    }
    
    public function cadastrar_aluno() {
        if ( ! isset($_POST['matricula'])) {
            redirect('login');
        }
        
        $error = $this->valida_senha_informada();
        
        if ($error !== NULL) {
            $this->aluno($error);
            return;
        }
        
        $params = array('matricula'  => $_POST['matricula'],
                        'nomeAluno'  => $_POST['nome'],
                        'email'      => $_POST['email'],
                        'idCurso'    => $_POST['curso'],
                        'senhaAluno' => $_POST['senha']
                    );
        
        require_once ABSPATH . '/models/aluno_model.php';
        $aluno_model = new AlunoModel();
        
        $error = $aluno_model->cadastrar($params);
        
        if ($error === NULL) {
            require_once ABSPATH . '/controllers/login_controller.php';
            $login_controller = new LoginController();
            $login_controller->logar_cadastro($_POST['matricula'], $_POST['senha']);
            return;
        }
        
        $error = $this->verifica_erro($error);
        
        $this->aluno($error);
    }
    
    private function valida_senha_informada() {
        $senha   = $_POST['senha'];
        $repetir = $_POST['repetir_senha'];
        
        if (strlen($senha) < 6) {
            return array('type' => 'danger', 'message' => "A Senha deve ter no mínimo 6 digitos!");
        } elseif (strcmp($senha, $repetir) !== 0) {
            return array('type' => 'danger', 'message' => "Os campos Senha e Repetir senha devem possuir o mesmo valor!");
        }
        return NULL;
    }

    private function verifica_erro($error) {
        if (stripos($error, "PRIMARY") !== false) {
            $message = "A matrícula informada já está cadastrado!";
        } elseif (stripos($error, "email") !== false) {
            $message = "O e-mail informado já está cadastrado!";
        }
        
        return array('type' => 'danger', 'message' => $message);
    }

}
