<?php if ( ! defined('ABSPATH')) exit;
require_once ABSPATH . '/models/base_model.php';

/**
 * Description of categoria_model
 *
 * @author Paulo
 */
class CursoModel extends BaseModel {
    
    private $table_name = "curso";
    
    public function __construct() {}
    
    public function find_cursos() {
        $projection = "idCurso, nomeCurso";
        $order_by = "nomeCurso ASC";
        
        $sql = "SELECT " . $projection .
                " FROM " . $this->table_name . 
                " ORDER BY " . $order_by;
        
        $this->create_connection();
        $result = $this->conn->query($sql);
        $this->close_connection();
        
        $cursos = array();
        
        if ($result->num_rows > 0) {
            $i = 0;
            while($row = $result->fetch_assoc()) {
                $cursos[$i] = array('idCurso' => $row['idCurso'], 'nomeCurso' => $row['nomeCurso']);
                $i++;
            }
        }
        
        return $cursos;
    }
    
    
    
}
