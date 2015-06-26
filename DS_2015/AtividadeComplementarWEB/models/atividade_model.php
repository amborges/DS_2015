<?php if ( ! defined('ABSPATH')) exit;
require_once ABSPATH . '/models/base_model.php';

/**
 * Description of categoria_model
 *
 * @author Paulo
 */
class AtividadeModel extends BaseModel {
    
    private $table_name = "ATIVIDADE";
    private $bool_erro_BD;
    private $msg_BD;
    
    public function __construct() {
    	$this->bool_erro_BD = FALSE;
    	$msg_BD = "";
    }
    
    public function cadastrar_nova_atividade($p, $fileAddress){
    	$matricula = $_SESSION['userdata']['matricula'];
    	$idcurso = $_SESSION['userdata']['idCurso'];
    	$seqAtividade = $this->getNextNumberToInsert($matricula);
    	
    	$fileAddress = explode("/", $fileAddress); //retorna só o nome do arquivo
    	$fileAddress = array_pop($fileAddress);
    	$datainicial = $this->adjustdata($p['datainicial']);
    	$datafinal = ($p['datafinal'] !== '') ? ($this->adjustdata($p['datafinal'])) : 'NULL';
    	
    	$sql2 = "INSERT INTO `DS_20151`.`".$this->table_name."` (`matricula`, `seqAtividade`, `descricaoAtividade`, `horaInformada`, `horaPermitida`, `dataInicio`, `dataFim`, `arquivo`, `validado`, `idCurso`, `seqGA`, `seqCategoria`) VALUES ('$matricula', '$seqAtividade', '".$p['descricao']."', '".$p['horas']."', '".$p['horas']."', '$datainicial', '$datafinal', '$fileAddress', '0', '$idcurso', '".$p['grandearea']."', '".$p['categoria']."');";
    	
    	$this->create_connection();
      $result = $this->conn->query($sql2);
    	if(!$result){ //deu erro na requisição
    		$this->bool_erro_BD = TRUE;
				$this->msg_BD = "FALHA: " . $this->conn->error;
    	}
    	$this->close_connection();
    }
    
    public function erro_BD(){
    	return $this->bool_erro_BD;
    }
    
    public function msg_erro(){
    	return $this->msg_BD;
    }
    
    private function getNextNumberToInsert($matricula){
    
    	$sql = "SELECT `seqAtividade` FROM `".$this->table_name."` 
					WHERE `matricula` = '" . $matricula . "' ORDER BY `seqAtividade` DESC;";
			
			$this->create_connection();
      $result = $this->conn->query($sql);
    	$this->close_connection();
    	
    	if($result->num_rows > 0){
				$seq = $result->fetch_assoc();
				return $seq['seqAtividade'] + 1;
			}
			
			return 0;
    }
    
    private function adjustData($d){
		$d = explode("/", $d);
		$d = $d[2] ."-". $d[1] ."-". $d[0];
		return $d;
	}
	
	public function getHorasAtividades(){
	
		$matricula = $_SESSION['userdata']['matricula'];
  	$idcurso = $_SESSION['userdata']['idCurso'];
	
		require_once ABSPATH . '/models/grande_area_model.php';
		
		$grandeareamodel = new GrandeAreaModel();
		$listaGA = $grandeareamodel->find_by_curso($idcurso);
		
		$listaRetorna = NULL;
		
		foreach($listaGA as $ga){
			$sql = "SELECT sum(`horaInformada`) FROM `".$this->table_name."` WHERE `matricula` = '$matricula' and `seqGA` = '". $ga['seqGA'] ."';";
			
			$this->create_connection();
		  $result = $this->conn->query($sql);
			$this->close_connection();
			$row = $result->fetch_assoc();
			
				//array($nomeGrandeArea, $acumulado, $minimo);
			$listaRetorna[] = array($ga['nomeGA'], $row['sum(`horaInformada`)'], $ga['horaMinima']);
			
  	}
		
		if($listaRetorna === NULL)
			$listaRetorna[] = array('NADA_A_APRESENTAR', 0, 0);
				
		return $listaRetorna;
	}
    
}
