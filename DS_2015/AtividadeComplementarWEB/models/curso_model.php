<?php if ( ! defined('ABSPATH')) exit;
require_once ABSPATH . '/models/base_model.php';

/**
 * Description of categoria_model
 *
 * @author Paulo
 */
class CursoModel extends BaseModel {
    
    private $table_name = "CURSO";
    
    public function __construct() {}
    
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
