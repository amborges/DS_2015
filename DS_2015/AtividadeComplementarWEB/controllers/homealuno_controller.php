<?php

/**
 * Description of home_controller
 *
 * @author Alex
 */
class HomeAlunoController {
  
    public function index() {
        if ( ! isset($_SESSION['userdata'])) {
            redirect('login');
        }

        require_once ABSPATH . '/functions/atividades_functions.php';

        /*
            Este post serve apenas para enviar os dados a serem mostrados no grafico
            Gerar um $_POST dinâmico, permitindo que se carregue quantos GrandeAreas
            forem necessárias, deve-se enviar o valor acumulado pelo aluno e o mínimo
            por cada GrandeArea. Aqui apenas coloquei 3 pra mostrar como vai ficar
        */

            //$_POST[$i] = array($nomeGrandeArea, $acumulado, $minimo);
        $_POST[0] = array('Ensino', 25, 100);
        $_POST[1] = array('Pesquisa', 75, 100);
        $_POST[2] = array('Extensao', 125, 100);

        $nome_aluno = $_SESSION['userdata']['nomeAluno'];
        $menus = AtividadesFunctions::init_menus(null, 0);
        $main_page = ABSPATH . '/views/homealuno_view.php';

        require ABSPATH . '/views/includes/template.php';
    }
    
    public function cadastrar($alert = NULL){
        if ( ! isset($_SESSION['userdata'])) {
            redirect('login');
        }

        require_once ABSPATH . '/functions/atividades_functions.php';
        
        $idCurso = $_SESSION['userdata']['idCurso'];
        
        

        $menus = AtividadesFunctions::init_menus(null, 2);
        $grandes_areas = $this->find_grande_areas();
        $main_page = ABSPATH . '/views/homealuno_cadastrar_view.php';

        require ABSPATH . '/views/includes/template.php';
    }
  
    public function visualizar(){
        if ( ! isset($_SESSION['userdata'])) {
            redirect('login');
        }

        require_once ABSPATH . '/functions/atividades_functions.php';
        $menus = AtividadesFunctions::init_menus(null, 3);
        $main_page = ABSPATH . '/views/homealuno_visualizar_view.php';

        require ABSPATH . '/views/includes/template.php';
    }   
  
    public function enviar(){
        if ( ! isset($_SESSION['userdata'])) {
            redirect('login');
        }

        require_once ABSPATH . '/functions/atividades_functions.php';
        $menus = AtividadesFunctions::init_menus(null, 4);
        $main_page = ABSPATH . '/views/homealuno_enviar_view.php';

        require ABSPATH . '/views/includes/template.php';
    }
  
    private function find_grande_areas() {
        if ( ! isset($_SESSION['userdata'])) {
          redirect('login');
        }
        require_once ABSPATH . '/models/grande_area_model.php';
        $id_curso = $_SESSION['userdata']['idCurso'];
        
        $grandes_area_model = new GrandeAreaModel();
        $grandes_areas = $grandes_area_model->find_by_curso($id_curso);
        
        return $grandes_areas;
    }
    
    public function find_categorias($id_curso, $id_grandearea) {
        //if ( ! isset($_SESSION['userdata'])) {
        //  redirect('login');
        //}
        //$id_curso = $_SESSION['userdata']['idCurso'];
        		//tive q comentar essa linha, pois o código que a chama não faz parte 
        		//da estrutura organizada do site. É o script dynamicComboBox.
        
        if ( ! defined('ABSPATH'))
        	require_once '../config.php';
                	
        require_once ABSPATH . '/models/categoria_model.php';;
        
        $categoria_model = new CategoriaModel();
        $categorias = $categoria_model->find_by_curso_and_grande_area($id_curso, $id_grandearea);
        
        if($categorias === NULL) return array('seqCategoria' => '0', 'nomeCategoria' => 'FAIL');
        
        return $categorias;
    }
  
}
