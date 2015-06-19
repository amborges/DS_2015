<?php if ( ! defined('ABSPATH')) exit;
require_once ABSPATH . '/models/base_model.php';

class GrandeAreaModel extends BaseModel {
    
    private $tabel_name = "GRANDEAREA";
    
    public function __construct() {}
    
    public function find_by_curso($id_curso) {
        $projection = "`seqGA` , `nomeGA`";
        $where = "`idCurso` = '".$id_curso."'";
        $order_by = "`nomeGA` ASC";
        
        $sql = "SELECT " . $projection .
                " FROM " . $this->tabel_name . 
                " WHERE " . $where . 
                " ORDER BY " . $order_by;
        
        $this->create_connection();
        $result = $this->conn->query($sql);
        $this->close_connection();
        
        $lista_grandes_areas;
        
        while($aux = $result->fetch_array())
        	$lista_grandes_areas[] = $aux;
        
        return $lista_grandes_areas;
    }
    
    public function nanana(){
    	//método nada a ver, só pra guardar o codigo abaixo
    	//ver como isso funciona pra usar no metodo abaixo
    	echo "*Select Category 
    		<select name='category' id='category' 
    			onChange=\"ajax('fill.php', '', 'populate', 'post', '1')\">
    			
    			<option value=''>--Please Select--</option>
    			<option value='1' >1</option>
    			<option value='2'>2</option>
    		</select>";
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
