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
        require_once ABSPATH . '/models/atividade_model.php';

        /*
            Este post serve apenas para enviar os dados a serem mostrados no grafico
            Gerar um $_POST dinâmico, permitindo que se carregue quantos GrandeAreas
            forem necessárias, deve-se enviar o valor acumulado pelo aluno e o mínimo
            por cada GrandeArea. Aqui apenas coloquei 3 pra mostrar como vai ficar
        */
        
        $atividademodel = new AtividadeModel();
        
        $_POST = $atividademodel->getHorasAtividades();

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
        require_once ABSPATH . '/models/atividade_model.php';
        require_once ABSPATH . '/models/grande_area_model.php';
        require_once ABSPATH . '/models/categoria_model.php';
        
        //primeiro é preciso buscas as atividades cadastradas
        $atividademodel = new AtividadeModel();
        
        $listatividades = $atividademodel->getAtividades();
        $atividades = NULL;
        $seq = 1;
        
        foreach($listatividades as $at){
        	$horasInf 	= ($at['horaInformada'] > 0)? $at['horaInformada'] : 0;
					$horasCont 	= ($at['horaPermitida'] > 0)? $at['horaPermitida'] : 0;
					$dataInicio	= invertAdjustData($at['dataInicio']);
					$dataFim = (strlen($at['dataFim']) > 1)? invertAdjustData($at['dataFim']) : 'NULL';
          $id_curso = $_SESSION['userdata']['idCurso'];
            
        	$atividades[] = array('id' => $seq,
								'descricao' => $at['descricaoAtividade'], 
								'grande_area' => $at['seqGA'],
								'categoria' => $at['seqCategoria'],
                'categorias' => $this->find_categorias($id_curso, $at['seqGA']),
								'horas' => $horasInf,
								'horascontabilizadas' => $horasCont,
								'data_inicial' => $dataInicio,
								'data_final' => $dataFim);
            $seq = $seq + 1;
		}
        
        $grandes_area_model = new GrandeAreaModel();
        $grandes_areas = $grandes_area_model->find_by_curso($id_curso);
        
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
        		//tive q comentar essa linha, pois tem código que a chama q não faz parte 
        		//da estrutura organizada do site. É o script dynamicComboBox.
        
        if ( ! defined('ABSPATH')) //caso quem chama for o dynamicComboBox
        	require_once '../config.php'; //carregar informações de configuração
                	
        require_once ABSPATH . '/models/categoria_model.php';;
        
        $categoria_model = new CategoriaModel();
        $categorias = $categoria_model->find_by_curso_and_grande_area($id_curso, $id_grandearea);
        
        if($categorias === NULL) return array('seqCategoria' => '0', 'nomeCategoria' => 'FAIL');
        
        return $categorias;
    }
  
}
