<?php if ( ! defined('ABSPATH')) exit;
require_once ABSPATH . '/models/base_model.php';

/**
 * Description of categoria_model
 *
 * @author Paulo
 */
class CoordenadorModel extends BaseModel {
    
    private $table_name = "COORDENADOR";
    private $bool_erro_BD;
    private $msg_BD;
    
    public function __construct() {
    	$this->bool_erro_BD = FALSE;
    	$msg_BD = "";
    }
    
    public function cadastrar_novo_professor($p){
    	$ehCoordenador = ($p['tipo'] === "coordenador") ? "1": "0";
    	$sql = "INSERT INTO `". $this->table_name ."`(`siape`, `nome`, `senha`, `usuarioAtivo`, `ehCoordenador`) VALUES ('".$p['siape']."','".$p['nome']."','".sha1($p['senha'])."','1','".$ehCoordenador."')";
    	
    	$this->create_connection();
      $result = $this->conn->query($sql);
    	if(!$result){ //deu erro na requisição
    		$this->bool_erro_BD = TRUE;
    		$this->msg_BD = $this->conn->error;
    	}
    	$this->close_connection();
    }
    
    public function erro_BD(){
    	return $this->bool_erro_BD;
    }
    
    public function msg_erro(){
    	return $this->msg_BD;
    }
    
    public function get_curso() {
    	//Apenas retorna a lista de cursos
        $projection = "idCurso,nomeCurso";
        $order_by = "nomeCurso ASC";
        
        $sql = "SELECT " . $projection .
                " FROM " . $this->table_name .
                " ORDER BY " . $order_by;
        
        $this->create_connection();
        $result = $this->conn->query($sql);
        $this->close_connection();
        
        while($aux = $result->fetch_array())
        	$res[] = $aux;
        
        return $res;
    }
    
}
