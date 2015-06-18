<?php if ( ! defined('ABSPATH')) exit;

/**
 * Description of base_model
 *
 * @author Paulo
 */
abstract class BaseModel {
    
    protected $conn;
    
    protected function create_connection() {
        $this->conn = new mysqli(HOSTNAME, DB_USER, DB_PASSWORD, DB_NAME);

		// Check connection
		if ($this->conn->connect_error) {
			throw new RuntimeException("Connection failed: " . $this->conn->connect_error);
        }
        
        $this->conn->set_charset("utf8");
    }
    
    protected function close_connection() {
        $this->conn->close();
    }
}
