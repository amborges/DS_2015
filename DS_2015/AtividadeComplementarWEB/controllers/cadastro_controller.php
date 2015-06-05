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
    
    public function aluno() {
        $cursos = NULL; // buscar da base de dados
        
        $main_page = ABSPATH . '/views/cadastro_aluno_page.php';
        
        require ABSPATH . '/views/includes/template.php';
    }
    
    public function cadastrar_aluno() {
        redirect('home');
    }
    
}
