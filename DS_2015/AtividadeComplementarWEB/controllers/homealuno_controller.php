<?php

/**
 * Description of home_controller
 *
 * @author Alex
 */
class HomeAlunoController {
		
		private $parametros;
	
		public function __construct($param = NULL){
			$this->parametros = $param;
		}
  
    public function index($alert = NULL) {
        if ( ! isset($_SESSION['userdata'])) {
            redirect('login');
        }

        require_once ABSPATH . '/functions/atividades_functions.php';
        require_once ABSPATH . '/models/atividade_model.php';
        
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
        require_once ABSPATH . '/models/aluno_model.php';
        
        $alunomodel = new AlunoModel();
        $jaenviou = $alunomodel->jaConcluiuAtividades();
        
        $idCurso = $_SESSION['userdata']['idCurso'];
        
        $menus = AtividadesFunctions::init_menus(null, 2);
        $grandes_areas = $this->find_grande_areas();
        $main_page = ABSPATH . '/views/homealuno_cadastrar_view.php';

        require ABSPATH . '/views/includes/template.php';
    }
  
    public function visualizar($alert = NULL){
        if ( ! isset($_SESSION['userdata'])) {
            redirect('login');
        }
        
        require_once ABSPATH . '/functions/atividades_functions.php';
        require_once ABSPATH . '/models/atividade_model.php';
        require_once ABSPATH . '/models/grande_area_model.php';
        require_once ABSPATH . '/models/categoria_model.php';
        require_once ABSPATH . '/models/aluno_model.php';
        
        $alunomodel = new AlunoModel();
        $jaenviou = $alunomodel->jaConcluiuAtividades();
        
        //primeiro é preciso buscas as atividades cadastradas
        $atividademodel = new AtividadeModel();
        
        $listatividades = $atividademodel->getAtividades();
        $atividades = NULL;
        $seq = 1;
        $id_curso = $_SESSION['userdata']['idCurso'];
        
        if($listatividades !== NULL){
		      foreach($listatividades as $at){
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
        
        $grandes_area_model = new GrandeAreaModel();
        $grandes_areas = $grandes_area_model->find_by_curso($id_curso);
        
        $menus = AtividadesFunctions::init_menus(null, 3);
        $main_page = ABSPATH . '/views/homealuno_visualizar_view.php';

        require ABSPATH . '/views/includes/template.php';
    }   
  
    public function enviar($alert = NULL){
        if ( ! isset($_SESSION['userdata'])) {
            redirect('login');
        }
        
        require_once ABSPATH . '/functions/atividades_functions.php';
        require_once ABSPATH . '/models/atividade_model.php';
        require_once ABSPATH . '/models/aluno_model.php';
        
        $alunomodel = new AlunoModel();
        $jaenviou = $alunomodel->jaConcluiuAtividades();
        
        $completouAsHoras = true; //predispoe que todas as GA estejam completos
        
        if(!$jaenviou){
        	$atividademodel = new AtividadeModel();
        	$ativ = $atividademodel->getHorasAtividades();
        
		      foreach($ativ as $a){
		      	if($a[1] < $a[2]) //horasAcumuladas < horaMinima
		      		$completouAsHoras = false;
		      }
	    	}
        
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
                	
        require_once ABSPATH . '/models/categoria_model.php';
        
        $categoria_model = new CategoriaModel();
        $categorias = $categoria_model->find_by_curso_and_grande_area($id_curso, $id_grandearea);
        
        if($categorias === NULL) return array('seqCategoria' => '0', 'nomeCategoria' => 'FAIL');
        
        return $categorias;
    }
    
    public function concluir_atividades($alert = NULL){
    	if ( ! isset($_SESSION['userdata'])) {
          redirect('login');
        }
        
        require_once ABSPATH . '/models/aluno_model.php';
        $alunomodel = new AlunoModel();
        $alunomodel->fecharAtividades();
        
        $alert = array('type' => 'success',
                       'message' => "Atividades Encerradas! Aguarde avaliação!");
        
        $this->index($alert);
    }
    
    public function delete(){
    	if ( ! isset($_SESSION['userdata'])) {
    		redirect('login');
    	} else if(sizeof($this->parametros) === 0){
    		redirect('homealuno');
    	}
    	
    	$seqAtividade = $this->parametros[0];
    	
    	require_once ABSPATH . '/models/atividade_model.php';
      $atividademodel = new AtividadeModel();
      $alert;
      $atividademodel->delete($seqAtividade);
    	
    	if($atividademodel->erro_BD())
    		$alert = array('type' => 'danger',
                       'message' => "Falha ao remover atividade: ".$atividademodel->msg_erro());
      else
      	$alert = array('type' => 'success',
                       'message' => "Atividade removida com sucesso!");
    	
    	$this->index($alert);
    }
  
}
