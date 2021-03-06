<?php if ( ! defined('ABSPATH')) exit;
require_once ABSPATH . '/models/base_model.php';

class GrandeAreaModel extends BaseModel {
    
    private $tabel_name = "GRANDEAREA";
    
    public function __construct() {}
    
    public function find_by_curso($id_curso) {
        $projection = "`seqGA` , `nomeGA`, `horaMinima`";
        $where = "`idCurso` = '".$id_curso."'";
        $order_by = "`nomeGA` ASC";
        
        $sql = "SELECT " . $projection .
                " FROM " . $this->tabel_name . 
                " WHERE " . $where . 
                " ORDER BY " . $order_by;
        
        
        $this->create_connection();
        $result = $this->conn->query($sql);
        $this->close_connection();
        
        $infos = array();
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $infos[$i] = array('seqGA' => $row['seqGA'], 'nomeGA' => $row['nomeGA'], 
                										'horaMinima' => $row['horaMinima']);
                $i++;
            }
        }
        return $infos;
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
        
        if (!$result) {
            throw new Exception("Database Error");
        }
        
        return $result->fetch_assoc();
    }
    
}
