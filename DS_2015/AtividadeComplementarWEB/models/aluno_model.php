<?php if ( ! defined('ABSPATH')) exit;
require_once ABSPATH . '/models/base_model.php';

/**
 * Description of aluno_model
 *
 * @author Paulo
 */
class AlunoModel extends BaseModel {
    
    private $table_name = "aluno";
    
    public function __construct() {}
    
    public function verifica_login($matricula, $senha) {
        $projection = "matricula, nomeAluno, idCurso";
        $where = "matricula = " . $matricula . " AND senhaAluno = '" . md5($senha) . "' AND alunoAtivo = 1";
        
        $sql = "SELECT " . $projection .
                " FROM " . $this->table_name . 
                " WHERE " . $where;
        
        $this->create_connection();
        $result = $this->conn->query($sql);
        $this->close_connection();
        
        return $result;
    }
    
    public function cadastrar($params)  {
        $colunas = "matricula, nomeAluno, idCurso, senhaAluno";
        $valores = $params["matricula"] . ", " .
                   "'" . $params["nomeAluno"] . "', " .
                   $params["idCurso"] . ", " .
                   "'" . md5($params["senhaAluno"]) . "'";
        
        if (isset($params["email"]) && ! empty($params["email"])) {
            $colunas .= ", email";
            $valores .= ", '" . $params['email'] . "'";
        }
                
        $colunas .= ", alunoAtivo";
        $valores .= ", 1";
        
        $sql = "INSERT INTO " . $this->table_name . " (" . $colunas . ")" . 
                " VALUES (" . $valores . ")";
        
        $error = NULL
            ;
        $this->create_connection();
        
        if ($this->conn->query($sql) !== TRUE) {
            $error = $this->conn->error;
        }
        
        $this->close_connection();
        
        return $error;
    }
    
}
