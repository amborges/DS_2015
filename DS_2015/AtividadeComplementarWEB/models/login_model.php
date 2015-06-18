<?php if ( ! defined('ABSPATH')) exit;
require_once ABSPATH . '/models/base_model.php';

/**
 * Description of login_model
 *
 * @author Paulo
 */
class LoginModel extends BaseModel {
    
    private $aluno_table_name = "aluno";
    private $coordenador_table_name = "coordenador";
    
    public function __construct() {}
    
    public function verifica_login_aluno($matricula, $senha) {
        $projection = "matricula, nomeAluno, idCurso";
        $where = "matricula = " . $matricula . " AND senhaAluno = '" . $senha . "' AND alunoAtivo = 1"; //md5($senha)
        
        $sql = "SELECT " . $projection .
                " FROM " . $this->aluno_table_name . 
                " WHERE " . $where;
        
        $this->create_connection();
        $result = $this->conn->query($sql);
        $this->close_connection();
        
        return $result;
    }
    
}
