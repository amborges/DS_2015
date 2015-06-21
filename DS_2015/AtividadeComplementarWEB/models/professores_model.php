<?php if ( ! defined('ABSPATH')) exit;
require_once ABSPATH . '/models/base_model.php';

/**
 * Description of professores_model
 *
 * @author Paulo
 */
class ProfessoresModel extends BaseModel {
    
    private $table_name = "coordenador";
    
    public function __construct() {}
    
    public function verifica_login($siape, $senha) {
        /*$projection = "matricula, nomeAluno, idCurso";
        $where = "matricula = " . $matricula . " AND senhaAluno = '" . $senha . "' AND alunoAtivo = 1"; //md5($senha)
        
        $sql = "SELECT " . $projection .
                " FROM " . $this->table_name . 
                " WHERE " . $where;
        
        $this->create_connection();
        $result = $this->conn->query($sql);
        $this->close_connection();
        
        return $result;*/
    }
    
}
