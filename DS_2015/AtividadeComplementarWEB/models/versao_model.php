<?php if ( ! defined('ABSPATH')) exit;
require_once ABSPATH . '/models/base_model.php';

/**
 * Description of versao_model
 *
 * @author Paulo
 */
class VersaoModel extends BaseModel {
    
    private $table_name = "VERSAO";
    
    public function __construct() {}
    
    public function find_versao_categoria() {
        return $this->find_versao("CATEGORIA");
    }
    
    public function find_versao_curso() {
        return $this->find_versao("CURSO");
    }
    
    public function find_versao_grandearea() {
        return $this->find_versao("GRANDEAREA");
    }
    
    private function find_versao($param) {
    	$projection = "versao";
        
        $sql = "SELECT " . $projection .
                " FROM " . $this->table_name .
                " WHERE nomeTabela = '" . $param . "'";
        
        $this->create_connection();
        $result = $this->conn->query($sql);
        $this->close_connection();
        
        if (!$result) {
            throw new Exception("Database Error");
        }
        
        return $result->fetch_assoc();
    }
    
}
