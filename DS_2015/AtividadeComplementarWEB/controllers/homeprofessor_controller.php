<?php

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
  
  public function validar() {
    require_once ABSPATH . '/functions/atividades_functions.php';
    
    
    if($this->parametros !== NULL){
    	$id_do_aluno = $this->parametros; //id do aluno
    	//BUSCA OS DADOS DO ALUNO e joga tudo no $_POST
    	$_GET = array(
    		/*"nome_do_campo"  => "valor_do_campo",*/
    		"nomealuno" => "Exemplo de Nome do Aluno",
    		"descricao" => "Exemplo de descrição",
    		"grandearea" => "Ensino",
    		"categoria" => "Ensino",
    		"horasinformadas" => 20,
    		"horasvalidas" => 10,
    		"datainicial" => "01/01/15",
    		"datafinal" => null,
    		"certificado" => "c1"
    	);
    }
    else{
		  //Essa variável envia para a view a lista de alunos em espera
		  $_POST = array(
		  	/*array($id_do_aluno, $nome_do_aluno, $atividades_conclusas, $total_de_atividades),*/
		  	array(1, "Joãozinho", 10, 25),
		  	array(1, "Mariazinha", 0, 50),
		  	array(2, "Zezinho", 15, 20)
		  );
		}
    
    
    
    $menus = AtividadesFunctions::init_menus("professor", 1);
    $main_page = ABSPATH . '/views/homeprofessor_validar_view.php';
    require ABSPATH . '/views/includes/template.php';
  }     
}