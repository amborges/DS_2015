<?php if ( ! defined('ABSPATH')) exit;
require_once ABSPATH . '/models/base_model.php';

/**
 * Description of login_model
 *
 * @author Paulo
 */
class LoginModel extends BaseModel {
    
    private $aluno_table_name = "ALUNO";
    private $coordenador_table_name = "COORDENADOR";
    
    public function __construct() {}
    
    public function verifica_login_aluno($matricula, $senha) {
        $projection = "matricula, nomeAluno, idCurso";
        $where = "matricula = '" . $matricula . "' AND senhaAluno = '" . sha1($senha) . "' AND alunoAtivo = 1"; //md5($senha) //ALEX: eu uso sha1... Mudamos?!
        
        $sql = "SELECT " . $projection .
                " FROM " . $this->aluno_table_name . 
                " WHERE " . $where;
        
        $this->create_connection();
        $result = $this->conn->query($sql);
        $this->close_connection();
        
        if($result != NULL && ! empty($result) && $result->num_rows > 0)
        	return $result->fetch_array();
        else
        	return NULL;
    }
    
}
