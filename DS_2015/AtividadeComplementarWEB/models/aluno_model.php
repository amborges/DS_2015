<?php if ( ! defined('ABSPATH')) exit;
require_once ABSPATH . '/models/base_model.php';

/**
 * Description of categoria_model
 *
 * @author Paulo
 */
class AlunoModel extends BaseModel {
    
    private $table_name = "ALUNO";
    private $bool_erro_BD;
    private $msg_BD;
    
    public function __construct() {
    	$this->bool_erro_BD = FALSE;
    	$msg_BD = "";
    }
    
    public function verifica_login($matricula, $senha) {
        $projection = "matricula, nomeAluno, idCurso";
        $where = "matricula = " . $matricula . " AND senhaAluno = '" . sha1($senha) . "' AND alunoAtivo = 1";
        
        $sql = "SELECT " . $projection .
                " FROM " . $this->table_name . 
                " WHERE " . $where;
                
        $this->create_connection();
        $result = $this->conn->query($sql);
        $this->close_connection();
        
        if($result->num_rows == 0)
        	return NULL;
        else
        	return $result->fetch_assoc();
    }
    
    public function cadastrar_novo_aluno($p){
    	$sql = "INSERT INTO `". $this->table_name ."`(`matricula`, `nomeAluno`, `senhaAluno`, `alunoAtivo`, `utilizouXML`, `idCurso`) VALUES ('".$p['matricula']."','".$p['nome']."','".sha1($p['senha'])."','1','0','".$p['curso']."')";
    	
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
        
        $res = NULL;
        
        while($aux = $result->fetch_array())
        	$res[] = $aux;
        
        return $res;
    }
    
    public function alunosToValidar(){
    	//retornar um array de array($id_do_aluno, $nome_do_aluno, $atividades_conclusas, $total_de_atividades)
    	
    	$sql = "SELECT `ALUNO`.`matricula`, `ALUNO`.`nomeAluno` , SUM( `ATIVIDADE`.`validado` ) , COUNT( `ATIVIDADE`.`validado` )
							FROM `ALUNO`
							INNER JOIN `ATIVIDADE` ON `ATIVIDADE`.`matricula` = `ALUNO`.`matricula`
							GROUP BY `ALUNO`.`matricula`
							ORDER BY `ALUNO`.`nomeAluno` ;";
              
      $this->create_connection();
      $result = $this->conn->query($sql);
      $this->close_connection();
      
      $res = NULL; 
        
      while($aux = $result->fetch_array())
      	$res[] = $aux;
       
      return $res;
    }
    
}
