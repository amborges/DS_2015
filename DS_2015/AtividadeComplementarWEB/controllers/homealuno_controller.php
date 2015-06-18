<?php

/**
 * Description of home_controller
 *
 * @author Alex
 */
class HomeAlunoController {
  
  
  public function index() {
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
    
  public function cadastrar(){
  	require_once ABSPATH . '/functions/atividades_functions.php';
  	
    $menus = AtividadesFunctions::init_menus(null, 2);
    $grandes_areas = $this->find_grande_areas();
  	$main_page = ABSPATH . '/views/homealuno_cadastrar_view.php';
      
  	require ABSPATH . '/views/includes/template.php';
  }
  
  public function visualizar(){
  	require_once ABSPATH . '/functions/atividades_functions.php';
  	$menus = AtividadesFunctions::init_menus(null, 3);
  	$main_page = ABSPATH . '/views/homealuno_visualizar_view.php';
      
  	require ABSPATH . '/views/includes/template.php';
  }   
  
  public function enviar(){
  	require_once ABSPATH . '/functions/atividades_functions.php';
  	$menus = AtividadesFunctions::init_menus(null, 4);
  	$main_page = ABSPATH . '/views/homealuno_enviar_view.php';
      
  	require ABSPATH . '/views/includes/template.php';
  }
  
  private function find_grande_areas() {
        require_once ABSPATH . '/models/grande_area_model.php';
        $id_curso = $_SESSION['userdata']['idCurso'];
        
        $grandes_area_model = new GrandeAreaModel();
        $result = $grandes_area_model->find_by_curso($id_curso);
        
        $grandes_areas = array();
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $grandes_areas[$i] = array('seqGA' => $row['seqGA'], 'nomeGA' => $row['nomeGA']);
                $i++;
            }
        }
        
        return $grandes_areas;
    }
  
}
