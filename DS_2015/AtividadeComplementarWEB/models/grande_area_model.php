<?php if ( ! defined('ABSPATH')) exit;
require_once ABSPATH . '/models/base_model.php';

class GrandeAreaModel extends BaseModel {
    
    private $tabel_name = "grandearea";
    
    public function __construct() {}
    
    public function find_by_curso($id_curso) {
        $projection = "seqGA, nomeGA";
        $where = "idCurso = " . $id_curso;
        $order_by = "nomeGA ASC";
        
        $sql = "SELECT " . $projection .
                " FROM " . $this->tabel_name . 
                " WHERE " . $where . 
                " ORDER BY " . $order_by;
        
        $this->create_connection();
        $result = $this->conn->query($sql);
        $this->close_connection();
        
        return $result;
    }
    
    public function find_by_curso_and_nomeGA($id_curso, $nome_GA) {
        $projection = "seqGA";
        $where = "idCurso = " . $id_curso . " AND nomeGA = '" . $nome_GA . "'";
        
        $sql = "SELECT " . $projection .
                " FROM " . $this->tabel_name . 
                " WHERE " . $where;
        
        $this->create_connection();
        $result = $this->conn->query($sql);
        $this->close_connection();
        
        return $result;
    }

}
