<?php if ( ! defined('ABSPATH')) exit;


/**
 * Description of home_controller
 *
 * @author Alex
 */
class HomeProfessorController {

	private $parametros;
	
	public function __construct($param = NULL){
		$this->parametros = $param;
	}
    
  public function index() {
    require_once ABSPATH . '/functions/atividades_functions.php';
    $menus = AtividadesFunctions::init_menus("professor", 0);
    $main_page = ABSPATH . '/views/homeprofessor_view.php';
    require ABSPATH . '/views/includes/template.php';
  }
  
  public function rejeitar_atividade($param = NULL) {  
    require_once ABSPATH . '/functions/atividades_functions.php';
    require_once ABSPATH . '/models/atividade_model.php';
    
    $menus = AtividadesFunctions::init_menus("professor", 1);
    
    $resumo = (new AtividadeModel())->getResumo($this->parametros[0], $this->parametros[1]);
    
    $main_page = ABSPATH . '/views/homeprofessor_rejeita_view.php';
    require ABSPATH . '/views/includes/template.php';
  }
  
  public function validar($alert = NULL) {
    require_once ABSPATH . '/functions/atividades_functions.php';
    require_once ABSPATH . '/models/aluno_model.php';
        
	  $alunomodel = new AlunoModel();
	  $_POST = $alunomodel->alunosToValidar();
		    
    $menus = AtividadesFunctions::init_menus("professor", 1);
    $main_page = ABSPATH . '/views/homeprofessor_validar_view.php';
    require ABSPATH . '/views/includes/template.php';
  }
  
  public function atualizar_atividade(){
  	require_once ABSPATH . '/functions/atividades_functions.php';
    require_once ABSPATH . '/models/atividade_model.php';
        
    $datainicio = adjustData($_POST['data_inicial']);
		$datafim = 'NULL';
		if($_POST['data_final'] !== '' && $_POST['data_final'] !== '00/00/0000')
			$datafim = adjustData($_POST['data_final']);		
		
		$listatividades = array(
			'matricula' => $_POST['matricula'],
			'seqAtividade' => $_POST['seqAtividade'],
			'descricao' => $_POST['descricao'],
			'grandearea' => $_POST['grande_area'],
			'categoria' => $_POST['categoria'],
			'horas' => $_POST['horas'],
			'horasCalculadas' => $_POST['horascalculadas'],
			'dataInicio' => $datainicio,
			'dataFim' => $datafim
		);
   
    $alert;
    $atividademodel = new AtividadeModel();
    
    if($listatividades !== NULL){	
    	$atividademodel->update_professor($listatividades);
    	if($atividademodel->erro_BD())
    		$alert = array('type' => 'danger',
                   'message' => "Falha ao atualizar as atividades: ". $atividademodel->msg_erro());
      else
      	$alert = array('type' => 'success',
                   'message' => "Atualização de atividades realizada com sucesso!");	
    }
    else
    	$alert = array('type' => 'danger',
                   'message' => "Não há atividades a serem atualizadas");
    
    $menus = AtividadesFunctions::init_menus(null, 0);
    	
    $main_page = ABSPATH . '/views/homealuno_view.php';
    
    require ABSPATH . '/views/includes/template.php';  	
  }
  
  public function concluintes($alert = NULL) {
    require_once ABSPATH . '/functions/atividades_functions.php';
    require_once ABSPATH . '/models/aluno_model.php';
        
    $alunomodel = new AlunoModel();
    $_POST = $alunomodel->alunosToValidar();
        

    $menus = AtividadesFunctions::init_menus("professor", 2);
    $main_page = ABSPATH . '/views/homeprofessor_concluintes_view.php';
    require ABSPATH . '/views/includes/template.php';
  }
  
  public function valide(){
    if($this->parametros === NULL)
    	redirect('homeprofessor/validar');
    	
    require_once ABSPATH . '/functions/atividades_functions.php';
    require_once ABSPATH . '/models/atividade_model.php';
    require_once ABSPATH . '/models/grande_area_model.php';
    require_once ABSPATH . '/models/categoria_model.php';
        
    //primeiro é preciso buscas as atividades cadastradas
    $atividademodel = new AtividadeModel();
    
    $matricula = $this->parametros[0];
    
    $listatividades = $atividademodel->getAtividades($matricula);
    
    $atividades = NULL;
    $seq = 0;
    $id_curso = $_SESSION['userdata']['idCurso'];
    
    if($listatividades !== NULL){
      foreach($listatividades as $at){
      	if($at['validado'] === '0'){
		    	$horasInf 	= ($at['horaInformada'] > 0)? $at['horaInformada'] : 0;
					$horasCont 	= ($at['horaPermitida'] > 0)? $at['horaPermitida'] : 0;
					$dataInicio	= invertAdjustData($at['dataInicio']);
					$dataFim = (strlen($at['dataFim']) > 1)? invertAdjustData($at['dataFim']) : 'NULL';
		      
		      $file;
		      $fileerror;
		      if(file_exists(ABSPATH.'/uploads/'.$at['arquivo'])){
		      	$file = $at['arquivo'];
		      	$fileerror = false;
		      }
		      else{
		      	$file = "filedoesntfind.pdf";
		      	$fileerror = true;
		      }
		                
		    	$atividades[] = array('id' => $seq,
		    				'seqAtividade' => $at['seqAtividade'],
								'descricao' => $at['descricaoAtividade'], 
								'grande_area' => $at['seqGA'],
								'categoria' => $at['seqCategoria'],
		            'categorias' => $this->find_categorias($id_curso, $at['seqGA']),
								'horas' => $horasInf,
								'horascontabilizadas' => $horasCont,
								'data_inicial' => $dataInicio,
								'data_final' => $dataFim,
								'validado' => $at['validado'],
								'certificado' => $file,
								'certificadocomerro' => $fileerror
					);
        	$seq = $seq + 1;
        }
			}
		}
    
    $grandes_area_model = new GrandeAreaModel();
    $grandes_areas = $grandes_area_model->find_by_curso($id_curso);
    
    $menus = AtividadesFunctions::init_menus("professor", 1);
    $main_page = ABSPATH . '/views/homeprofessor_valide_view.php';
    require ABSPATH . '/views/includes/template.php';
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
