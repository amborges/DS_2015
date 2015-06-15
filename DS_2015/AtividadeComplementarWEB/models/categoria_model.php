<?php if ( ! defined('ABSPATH')) exit;
require_once ABSPATH . '/models/base_model.php';

/**
 * Description of categoria_model
 *
 * @author Paulo
 */
class CategoriaModel extends BaseModel {
    
    private $table_name = "categoria";
    
    public function __construct() {}
    
    public function find_by_curso_and_grande_area($id_curso, $seq_GA) {
        $projection = "seqCategoria, nomeCategoria";
        $where = "idCurso = " . $id_curso . " AND seqGA = " . $seq_GA;
        $order_by = "nomeCategoria ASC";
        
        $sql = "SELECT " . $projection .
                " FROM " . $this->table_name . 
                " WHERE " . $where . 
                " ORDER BY " . $order_by;
        
        $this->create_connection();
        $result = $this->conn->query($sql);
        $this->close_connection();
        
        return $result;
    }
    
}
